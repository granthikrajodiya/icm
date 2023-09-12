<?php

namespace App\Http\Controllers;

use App\Http\Requests\Activity\ActivityStoreRequest;
use App\Http\Requests\Activity\ActivityUpdateRequest;
use App\Models\Activity;
use App\Models\User;
use App\Models\Utility;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ActivityController extends Controller
{
    public function index($orderBy = 'date_desc')
    {
        if (Session::has('navigation_title')) {
            Session::forget('navigation_title');
        }

        if ($orderBy == 'date_asc') {
            $orderBy = 'asc';
        } else {
            $orderBy = 'desc';
        }

        if (Utility::getValByName('show_activities') != 1) {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }

        $sub        = Activity::orderBy('id', 'DESC')->limit(300);
        $activities = DB::table(DB::raw("({$sub->toSql()}) as sub"))->mergeBindings($sub->getQuery())->whereIn('user_id', [
            user()->id,
            0,
        ])->orderBy('date_time', $orderBy)->get();

        return view('activity.index', compact('activities'));
    }

    public function addActivity(ActivityStoreRequest $request): JsonResponse
    {
        $user = User::where('username', '=', $request->get('username'))->first();

        $activity = Activity::create($request->merge([
            "user_id" => $user->id
        ])->toArray());

        return $this->formatResponse(true, __('Activity Added Successfully.'), $activity);
    }

    public function updateActivity(ActivityUpdateRequest $request, ?Activity $activity): JsonResponse
    {
        if (is_null($activity)) {
            return response()->json($this->formatResponse(false, 'Record not found.'));
        }

        $activity->update($request->validated());

        return $this->formatResponse(true, __('Activity Updated Successfully.'), $activity);
    }

    public function deleteActivity(?Activity $activity): JsonResponse
    {
        if (is_null($activity)) {
            return response()->json($this->formatResponse(false, 'Record not found.'));
        }

        $activity->delete();

        return $this->formatResponse(true, __('Activity Deleted Successfully.'));
    }

    private function formatResponse($success = false, $message = '', $data = []): JsonResponse
    {
        return response()->json([
            'is_success' => $success,
            'message'    => $message,
            'data'       => $data,
        ]);
    }
}
