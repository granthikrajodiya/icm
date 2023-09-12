<?php

namespace App\Http\Controllers;

use App\Actions\GetCalendarFormattedData;
use App\Http\Requests\API\Calendar\EventStoreRequest;
use App\Http\Requests\API\Calendar\EventUpdateRequest;
use App\Models\Calendar;
use App\Models\ModulePermissionAssignment;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Utility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

/**
 * @SuppressWarnings(PHPMD)
 */
class CalendarController extends Controller {
    public function __construct() {
        $this->middleware('verify.create-by-or-admin')->only(['edit', 'update']);
    }

    public function index() {
        $user = user();

        $calendars = Calendar::filterAccountType($user)->get();

        $arrData = GetCalendarFormattedData::execute($calendars);

        $userPerms = $this->identifyPermissions();
        $timezones = $this->readTimezonesJson();

        return view('calendar.index', compact('arrData', 'userPerms', 'timezones'));
    }

    public function create() {
        $startTime = date('H', strtotime('now')) . ':00';
        $endTime   = date('H', strtotime('now')) . ':30';

        $userPerms = $this->identifyPermissions();
        $timezones = $this->readTimezonesJson();


        return view('calendar.create', compact(
            'timezones',
            'startTime',
            'endTime',
            'userPerms'
        ));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'       => 'required|max:255',
            'scope_type' => 'required',
            'start_date' => 'required|date',
            'end_date'   => 'required|date',
            'color'      => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->getMessageBag()->first());
        }

        $user               = user();
        $post               = $request->all();
        $post['scope']      = $request->scope_type;
        $post['created_by'] = $user->id;
        $post['username']   = $user->username;
        $post['tenant_id']  = $user->tenant_id;
        $calendar = Calendar::create($post);

        $currDateTime = \Carbon\Carbon::now()->toDateTimeString();
        user()->activities()->create([
            'type'      => 'calendar',
            'date_time' => $currDateTime,
            'text'      => 'Event created successfully at ' . Utility::getDateFormatted($currDateTime, true),
            'reference_id' => $calendar->id
        ]);
        return redirect()->back()->with('success', __('Event Created Successfully!'));
    }

    public function show(Calendar $calendar) {
        return view('calendar.show', compact('calendar'));
    }

    public function edit(Calendar $calendar) {

        $userPerms = $this->identifyPermissions();
        $timezones = $this->readTimezonesJson();

        return view('calendar.edit', compact('calendar', 'userPerms', 'timezones'));
    }

    public function update(Request $request, Calendar $calendar) {
        $validator = Validator::make($request->all(), [
            'name'       => 'required|max:255',
            'scope_type' => 'required',
            'start_date' => 'required|date',
            'end_date'   => 'required|date',
            'color'      => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $post              = $request->all();
        $post['scope']     = $request->scope_type;
        $post['username']  = Auth::user()->username;
        $post['tenant_id'] = Auth::user()->tenant_id;

        $calendar->update($post);

        $currDateTime = \Carbon\Carbon::now()->toDateTimeString();
        user()->activities()->create([
            'type'      => 'calendar',
            'date_time' => $currDateTime,
            'text'      => 'Event updated successfully at ' . Utility::getDateFormatted($currDateTime, true),
            'reference_id' => $calendar->id
        ]);

        return redirect()->back()->with('success', __('Event Updated Successfully!'));
    }

    public function destroy(Calendar $calendar): RedirectResponse {
        $calendar->delete();

        return redirect()->back()->with('success', __('Event Deleted Successfully!'));
    }

    public function calendarDrag(Request $request, ?Calendar $calendar) {
        $calendar->start_date = $request->start;
        $calendar->end_date   = $request->end;
        $calendar->save();
    }

    public function addEvent(EventStoreRequest $request): JsonResponse {

        $startDate = Carbon::parse($request->get('start_date') . ' ' . $request->get('start_time'));
        $endDate   = Carbon::parse($request->get('end_date') . ' ' . $request->get('end_time'));

        //request validation
        $post = $request->validated();

        //datetime setting
        $post['all_day']    = $post['all_day'] ?? 0;
        $post['timezone']   = $post['timezone'] ?? null;
        $post['start_time'] = $startDate->format('H:i:m:s') ?? '00:00:00';
        $post['endtime']    = $endDate->format('H:i:m:s') ?? '00:00:00';
        $post['created_by'] = $post['created_by'] ?? 0;

        //scope/username/tenant_id validation
        $username  = $post['username'] ?? null;
        $scope     = $post['scope'];
        $tenant_id = $post['tenant_id'] ?? null;

        //scope tenant, tenant_id is required
        if (strcasecmp($scope, "tenant") == 0) {

            if (!$tenant_id) {
                //missing tenant_id || null
                return response()->json([
                    'is_success' => "false",
                    'message'    => __('Missing tenant_id. Scope is set to tenant, so tenant_id value is required.'),
                ]);

            } else {

                //tenant_id value check
                $tenant = Tenant::where('tenant_id', $tenant_id)->first();
                if (empty($tenant)) {
                    return response()->json([
                        'is_success' => "false",
                        'message'    => __('API tenant_id value does not exist in the DB.'),
                    ]);
                }

            }
        }

        //scope user, tenant_id and username is required
        if (strcasecmp($scope, "user") == 0) {

            if (!$tenant_id) {

                //missing tenant_id || null
                return response()->json([
                    'is_success' => "false",
                    'message'    => __('Missing tenant_id. Scope is set to user, so tenant_id value is required.'),
                ]);

            } elseif (!$username) {
                //missing username || null
                return response()->json([
                    'is_success' => "false",
                    'message'    => __('Missing username. Scope is set to user, so username value is required.'),
                ]);
            } else {

                //username and tenant_id value check
                $user = User::where('tenant_id', $tenant_id)
                    ->where('username', $username)
                    ->first();

                if (empty($user)) {
                    return response()->json([
                        'is_success' => "false",
                        'message'    => __('API username with tenant_id values does not exist in the DB.'),
                    ]);
                }
            }
        }

        $arrRecord = Calendar::create($post);

        return response()->json($this->formatResponse(true, __('Calendar Event Added Successfully.'), $arrRecord));
    }

    public function updateEvent(EventUpdateRequest $request, ?Calendar $calendar): JsonResponse {
        if (is_null($calendar)) {
            return response()->json($this->formatResponse(false, 'Record not found.'));
        }

        $startDate = Carbon::parse($request->get('start_date') . ' ' . $request->get('start_time'));
        $endDate   = Carbon::parse($request->get('end_date') . ' ' . $request->get('end_time'));

        $post = $request->validated();

        if (isset($post['created_by'])) {
            unset($post['created_by']);
        }
        //datetime setting
        $post['all_day']    = $post['all_day'] ?? 0;
        $post['timezone']   = $post['timezone'] ?? null;
        $post['start_time'] = $startDate->format('H:i:m:s') ?? '00:00:00';
        $post['endtime']    = $endDate->format('H:i:m:s') ?? '00:00:00';

        //scope/username/tenant_id validation
        $username  = $post['username'] ?? null;
        $scope     = $post['scope'];
        $tenant_id = $post['tenant_id'] ?? null;

        //scope tenant, tenant_id is required
        if (strcasecmp($scope, "tenant") == 0) {

            if (!$tenant_id) {
                //missing tenant_id || null
                return response()->json([
                    'is_success' => "false",
                    'message'    => __('Missing tenant_id. Scope is set to tenant, so tenant_id value is required.'),
                ]);

            } else {

                //tenant_id value check
                $tenant = Tenant::where('tenant_id', $tenant_id)->first();
                if (empty($tenant)) {
                    return response()->json([
                        'is_success' => "false",
                        'message'    => __('API tenant_id value does not exist in the DB.'),
                    ]);
                }

            }
        }

        //scope user, tenant_id and username is required
        if (strcasecmp($scope, "user") == 0) {

            if (!$tenant_id) {

                //missing tenant_id || null
                return response()->json([
                    'is_success' => "false",
                    'message'    => __('Missing tenant_id. Scope is set to user, so tenant_id value is required.'),
                ]);

            } elseif (!$username) {
                //missing username || null
                return response()->json([
                    'is_success' => "false",
                    'message'    => __('Missing username. Scope is set to user, so username value is required.'),
                ]);
            } else {

                //username and tenant_id value check
                $user = User::where('tenant_id', $tenant_id)
                    ->where('username', $username)
                    ->first();

                if (empty($user)) {
                    return response()->json([
                        'is_success' => "false",
                        'message'    => __('API username with tenant_id values does not exist in the DB.'),
                    ]);
                }
            }
        }

        $arrRecord = $calendar->update($post);

        return response()->json($this->formatResponse(true, 'Calendar Event Updated Successfully.', $arrRecord));
    }

    public function deleteEvent(?Calendar $calendar): JsonResponse {
        if (is_null($calendar)) {
            return response()->json($this->formatResponse(false, 'Record not found.'));
        }

        $calendar->delete();

        return response()->json([
            'is_success' => "true",
            'message'    => __('Calendar Event Deleted Successfully.'),
        ]);
    }

    private function formatResponse($success = false, $message = '', $data = []): array
    {
        return [
            'is_success' => $success,
            'message'    => $message,
            'data'       => $data,
        ];
    }

    private function readTimezonesJson():array
    {
        $jsonFile =  storage_path('json/timezones.json');
        $data   = file_get_contents($jsonFile);
        $timezones = json_decode($data, true);

        return $timezones;
    }

    private function identifyPermissions():array
    {

        //for permissions
        $usrData    = Session::get('userInfo');
        $userGroups = $usrData->UserGroups ?? [];

        $permsAssignment = ModulePermissionAssignment::all();

        //identifying user permissions
        $userPerms = [];
        if (user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            $userPerms[] = 'CALENDAR_ALL_TENANTS';
        }elseif(user()->account_type == User::EXTERNAL_TENANT_ADMIN){
            $userPerms[] = 'CALENDAR_USER_TENANT';
        }elseif(user()->account_type == User::EXTERNAL_TENANT_USER){
            $userPerms[] = 'CALENDAR_PERSONAL';
        }else{
            foreach ($userGroups as $usg) {
                foreach ($permsAssignment as $perms) {
                    if ($perms['group_name'] === $usg) {
                        if ($perms['module_name'] == 'Calendar' && $perms['permission_key'] == 'ALL_TENANTS') {
                            $userPerms[] = 'CALENDAR_ALL_TENANTS';
                        }
                        if ($perms['module_name'] == 'Calendar' && $perms['permission_key'] == 'USER_TENANT') {
                            $userPerms[] = 'CALENDAR_USER_TENANT';
                        }
                        if ($perms['module_name'] == 'Calendar' && $perms['permission_key'] == 'PERSONAL') {
                            $userPerms[] = 'CALENDAR_PERSONAL';
                        }
                    }
                }
            }
        }


        return $userPerms;
    }
}
