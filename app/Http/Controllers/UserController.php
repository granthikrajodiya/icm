<?php

namespace App\Http\Controllers;

use App\Facades\ILINX;
use App\Http\Requests\API\User\UserUpdateRequest;
use App\Mail\TaskEmail;
use App\Models\Email;
use App\Models\Layout;
use App\Models\Navigation;
use App\Models\Note;
use App\Models\Tenant;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\Utility;
use App\Services\Authentication\AuthenticationService;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * @SuppressWarnings(PHPMD)
 */
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('mail.config')->only('emailStore');
    }

    public function profile()
    {
        $user = user();

        if ($user->account_type != 3) {
            // Unset Navigation Title
            if (Session::has('navigation_title')) {
                Session::forget('navigation_title');
            }

            return view('users.profile', compact('user'));
        }

        return redirect()->back()->with('error', __('Permission Denied.'));
    }

    public function updateProfile(Request $request)
    {
        $objUser = user();
        if ($objUser->account_type != 3) {
            $validate = [];

            if ($request->from == 'profile') {
                $validate = [
                    'name'  => 'required|max:120',
                ];

                if ($request->communication_channel == 'text') {
                    $validate['texting_number'] = 'required|max:20';
                }
            } elseif ($request->from == 'password') {
                $validate = [
                    'old_password'     => 'required',
                    'new_password'     => 'required|min:8',
                    'confirm_password' => 'required|min:8|same:new_password',
                ];
            }

            if (isset($request->avatar) && !empty($request->avatar)) {
                $validate = [
                    'avatar' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            }

            $validator = Validator::make(
                $request->all(),
                $validate
            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            $post = $request->all();

            // remove email from array we don't need to update that email
            unset($post['email']);

            // Image Uploading
            if ($request->avatar) {
                Utility::checkFileExistsNDelete([$objUser->avatar]);
                $post['avatar'] = Storage::disk()->put('avatars', $request->file('avatar'));
            }

            // Password Confirmation
            if ($request->from == 'password') {
                $post['password'] = Hash::make($request->new_password);

                // API CALL FOR CHANGE PASSWORD
                $resp = self::userProfileUpdate($request);

                if ($resp->Success == false) {
                    return redirect()->back()->with('error', $resp->ErrorMessage);
                }

                $objUser->update($post);
            } else {
                $objUser->update($post);
            }

            if ($request->avatar) {
                return redirect()->back()->with('success', __('Avatar Updated Successfully!'));
            }
            if ($request->from == 'profile') {
                return redirect()->back()->with('success', __('Profile Updated Successfully!'));
            }
            if ($request->from == 'password') {
                return redirect()->back()->with('success', __('Password Updated Successfully!'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    // Custom Password Reset Page
    public function passwordReset(AuthenticationService $authentication)
    {
        if (\Auth::check()) {
            return redirect()->route('home');
        }

        if ($authentication->usesExternalAuthentication()) {
            $url = $authentication->withTenantService()->getLoginUrl();

            return \Redirect::to($url);
        }

        $tenantId = !empty(tenant('tenant_id')) ? tenant('tenant_id') : 'host';

        return view('auth.password_reset', compact('tenantId'));
    }
    // End Custom Password Reset Page

    // API CALL FOR DOCUMENTS
    public function docsIndex($docs, $orderBy = '')
    {
        $usrData  = Session::get('userInfo');
        $dataMenu = HomeController::getMenu();
        $docsData = HomeController::getBatchDocs($dataMenu->BatchID ?? "");

        $cntDoc       = 0;
        $arrFields    = [];
        $documentData = [];
        $docArray     = [];

        if (!empty($docData)) {
            foreach ($docsData->Data as $key => $doc) {
                if ($doc->DocTypeName == $docs) {
                    $documentData[Utility::GetDocProp($doc, 'Title') . '-' . $key] = $doc;
                    $docArray                                                      = $doc;
                }
            }
        }

        if ($orderBy == 'newest') {
            $documentData = array_reverse($documentData);
        } else {
            $orderBy == 'asc' ? ksort($documentData) : krsort($documentData);
        }

        foreach ($docArray as $docData) {
            $cntDoc++;
            $arrFields = Utility::GetTableRowDynamicIndexes($docData);
        }

        $arrDocData = [
            'cntDoc'    => $cntDoc,
            'cntNewDoc' => Utility::newCount($docArray),
            'arrFields' => $arrFields,
        ];

        $newDocUrl = Utility::GetDocProp($dataMenu, 'NewDocumentURL');

        return view('docs.index', compact('docs', 'usrData', 'arrDocData', 'newDocUrl', 'documentData', 'orderBy'));
    }

    public function docsGridIndex($docs, $orderBy = '')
    {
        $usrData  = Session::get('userInfo');
        $dataMenu = HomeController::getMenu();
        $docsData = HomeController::getBatchDocs($dataMenu->BatchID ?? null);

        $cntDoc       = 0;
        $arrFields    = [];
        $documentData = [];
        $docArray     = [];

        if (!empty($docsData) && $docsData != "The requested URL returned error: 400") {
            foreach ($docsData->Data as $key => $doc) {
                if ($doc->DocTypeName == $docs) {
                    $documentData[Utility::GetDocProp($doc, 'Title') . '-' . $key] = $doc;
                    $docArray                                                      = $doc;
                }
            }
        }

        if ($orderBy == 'newest') {
            $documentData = array_reverse($documentData);
        } else {
            $orderBy == 'asc' ? ksort($documentData) : krsort($documentData);
        }

        foreach ($docArray as $docData) {
            $cntDoc++;
            $arrFields = Utility::GetTableRowDynamicIndexes($docData);
        }

        $arrDocData = [
            'cntDoc'    => $cntDoc,
            'cntNewDoc' => Utility::newCount($docArray),
            'arrFields' => $arrFields,
        ];

        $newDocUrl = Utility::GetDocProp($dataMenu, 'NewDocumentURL');

        return view('docs.indexGrid', compact('docs', 'usrData', 'arrDocData', 'newDocUrl', 'documentData', 'orderBy'));
    }

    public function docFetch(Request $request)
    {
        return redirect()->route('docs.view', [
            tenant('tenant_id'),
            $request->record,
        ]);
    }

    public function docDetail($docId)
    {
        $usrData   = Session::get('userInfo');
        $dataBatch = HomeController::getMenu();
        $document  = HomeController::getDocById($dataBatch->BatchID, $docId)->Data;

        $arrDocData                = [];
        $arrDocData['DocTypeName'] = $document->DocTypeName;
        $arrDocData['DocTitle']    = Utility::GetDocProp($document, 'Title');

        $frameUrl = config('ilinx.ic_url') . 'get-doc?batchID=' . $dataBatch->BatchID . '&docID=' . $docId . '&fileFormat=pdf';

        return view('docs.detail', compact('arrDocData', 'frameUrl', 'usrData'));
    }

    public function docPopup()
    {
        $usrData   = Session::get('userInfo');
        $dataMenu  = HomeController::getMenu();
        $addDocUrl = Utility::GetDocProp($dataMenu, 'NewDocumentURL');

        return view('docs.popup', compact('usrData', 'addDocUrl'));
    }

    // API CALL FOR CHILD BATCHES (TABLE)
    public function batchDetail($table)
    {
        $usrData  = Session::get('userInfo');
        $dataMenu = HomeController::getMenu();

        $cntBatch  = 0;
        $arrFields = [];
        $isEmpty   = true;

        foreach ($dataMenu->IndexValues as $indexValue) {
            if ($indexValue->DataType == '_table' && $indexValue->IndexName == $table) {
                $isEmpty = Utility::checkChildEmpty($indexValue->TableValue->RowValues[0]);

                foreach ($indexValue->TableValue->RowValues as $v) {
                    $cntBatch++;

                    $rows = Utility::GetBatchTableRowDynamicIndexes($v->ColumnValues);
                    foreach ($rows as $r) {
                        $arrFields[] = Str::substr($r->Name, 4);
                    }
                }
            }
        }

        $arrBatchData = [
            'cntBatch'  => $cntBatch,
            'arrFields' => array_unique($arrFields),
        ];

        if ($isEmpty != true) {
            return view('batches.index', compact('table', 'usrData', 'dataMenu', 'arrBatchData'));
        }

        return redirect()->back()->with('error', __('No record found in ') . $table);
    }

    public function batchGridDetail($table)
    {
        $usrData  = Session::get('userInfo');
        $dataMenu = HomeController::getMenu();

        $cntBatch  = 0;
        $arrFields = [];

        foreach ($dataMenu->IndexValues as $indexValue) {
            if ($indexValue->DataType == '_table' && $indexValue->IndexName == $table) {
                foreach ($indexValue->TableValue->RowValues as $v) {
                    $cntBatch++;
                    $rows = Utility::GetBatchTableRowDynamicIndexes($v->ColumnValues);
                    foreach ($rows as $r) {
                        $arrFields[] = Str::substr($r->Name, 4);
                    }
                }
            }
        }

        $arrBatchData = [
            'cntBatch'  => $cntBatch,
            'arrFields' => array_unique($arrFields),
        ];

        if ($arrBatchData['cntBatch'] > 1) {
            return view('batches.indexGrid', compact('table', 'usrData', 'dataMenu', 'arrBatchData'));
        }

        return redirect()->back()->with('error', __('Permission Denied.'));
    }

    public function batchFormDetail($batchName, $title)
    {
        $usrData  = Session::get('userInfo');
        $dataMenu = HomeController::getMenu();
        $url      = '';

        foreach ($dataMenu->IndexValues as $indexValue) {
            if ($indexValue->DataType == '_table' && $indexValue->IndexName == $batchName) {
                foreach ($indexValue->TableValue->RowValues as $v) {
                    $subBatchTitle = Utility::GetTableRowColumnValue($v->ColumnValues, 'Title');

                    if (!empty($subBatchTitle) && $subBatchTitle == $title) {
                        $url = Utility::GetTableRowColumnValue($v->ColumnValues, 'ViewUrl');
                    }
                }
            }
        }

        return view('batches.form_detail', compact('batchName', 'title', 'url', 'usrData'));
    }

    // API CALL FOR FORM DATA
    public function formIndex($view = '', $order = '') {
        $forms   = Utility::getFormMenu();
        $orderBy = $order; // For List View
        $viewBy  = $view; // For Grid View

        if ($forms->Success == true) {
            if ($view == 'list') {
                return view('forms.index', compact('forms'), compact('orderBy'));
            } else {
                return view('forms.indexGrid', compact('forms'), compact('view'));
            }

            return view('forms.indexGrid', compact('forms'));
        }

        return redirect()->back()->with('error', __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.'));
    }

    // API CALL FOR FORM DATA
    public static function fetchSingleFormContentTypes()
    {
        $forms = Utility::getFormMenu();
        if (!$forms->Success) {
            $err               = new \stdClass();
            $err->Success      = false;
            return $err;
        }

        $data               = new \stdClass();
        $data->Success = $forms->Success;
        $data->Data = [];
        foreach ($forms->Data as $index => $datum) {
            $data->Data[$datum->ID] = $datum->Name;
        }
        return $data;
    }

    public function formDetail($formId)
    {
        $usrData  = Session::get('userInfo');
        $forms    = Utility::getFormMenu();
        $height   = 720;
        $formData = [];

        if ($forms->Success == true) {
            foreach ($forms->Data as $form) {
                if ($form->ID == $formId) {
                    $formData = $form;

                    if ($form->FormFrameHeight > $height) {
                        $formData->height = $form->FormFrameHeight;
                    } else {
                        $formData->height = $height;
                    }
                }
            }

            // Make sure we found the eForm being requested
            if (empty($formData)) {
                return redirect()->back()->with('error', __('You do not have permission to access this form. Please contact your system administrator'));
            }

            return view('forms.detail', compact('formData', 'usrData'));
        }

        return redirect()->back()->with('error', __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.'));
    }

    // FOR CUSTOM URL BASED EFORM
    public function eFormDetail($viewId)
    {
        $usrData = Session::get('userInfo');
        if (strpos($viewId, 'n_') !== false) {
            $viewId = ltrim($viewId, 'n_');
            $view   = Navigation::find($viewId);
        } else {
            $view = Layout::find($viewId);
        }

        return view('forms.custom_eform', compact('view', 'usrData'));
    }

    // Manage API For Update User Based on Username
    public function userUpdate(UserUpdateRequest $request, ?User $user): JsonResponse
    {
        if (is_null($user)) {
            return response()->json($this->formatResponse(false, 'Record not found.'));
        }

        $user->update($request->validated());

        return response()->json([
            'is_success' => "true",
            'message'    => __('User Updated Successfully.'),
            'data'       => $user,
        ]);
    }

    public static function userProfileUpdate($userData)
    {
        $json = ILINX::user()->update($userData);

        if ($json->Success != true) {
            // Return some appropriate error to user here
            Utility::ILINXLog('ERROR userProfileUpdate ILINX update-builtin-user REST error: ' . $json->ErrorMessage);

            $err               = new \stdClass();
            $err->Success      = false;
            $err->ErrorMessage = __('An error occurred while attempting to update your password.');

            return $err;
        }

        Utility::ILINXLog('DEBUG update-builtin-user success');

        $userInfo = session('userInfo');
        $response = ILINX::auth()->login($userInfo?->Username ?: '', $userData->new_password);

        if (!empty($response) && $response->Success == 'true') {
            $responseData = $response->Data;
            $responseData->TenantId = tenant('tenant_id');
            Session::put('userInfo', $responseData);
            Utility::ILINXLog('DEBUG [updated] login success');
        } else {
            // Return some appropriate error to user here
            $err               = new \stdClass();
            $err->Success      = false;
            $err->ErrorMessage = __('An error occurred while attempting to update your password.');

            return $err;
        }

        // Return the appropriate info based on success
        return $json;
    }

    // Add Notes
    public function addTaskNote($id, Request $request)
    {
        $note = Note::where('created_by', '=', user()->id)->where('batch_id', 'LIKE', $id)->first();
        if (empty($note)) {
            Note::create([
                'batch_id'   => $id,
                'notes'      => $request->notes,
                'created_by' => user()->id,
            ]);
        } else {
            $note->notes = $request->notes;
            $note->save();
        }

        return response()->json(
            [
                'is_success' => true,
                'success'    => __('Note successfully saved!'),
            ],
            200
        );
    }

    // Send For Email
    public function emailCreate($batchId)
    {
        return view('tasks.emails', ['batchId' => $batchId]);
    }

    public function emailStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'to'          => 'required|email',
            'subject'     => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first())->with('task-tab-status', 'emails');
        }

        $taskEmail = Email::create([
            'batch_id'    => $request->batch_id,
            'to'          => $request->to,
            'subject'     => $request->subject,
            'description' => $request->description,
            'created_by'  => user()?->id,
        ]);

        try {
            Mail::to($request->to)->send(new TaskEmail($taskEmail));
        } catch (\Exception$e) {
            $smtpError = __('E-Mail has been not sent due to SMTP configuration');
        }

        return redirect()->back()->with(
            'success',
            __(
                'Email successfully added!'
            ) . ((isset($smtpError)) ? '<br> <span class="text-danger">' . $smtpError . '</span>' : '')
        )->with('task-tab-status', 'emails');
    }

    // For Language
    public function changeLang($lang)
    {
        $user       = user();
        $user->lang = $lang;
        $user->save();

        return redirect()->back()->with('success', __('Language Change Successfully!'));
    }

    // For Navigation Title (like breadcrumb)
    public function getBreadcrumb(Request $request)
    {
        if (isset($request->title) && !empty($request->title)) {
            if (Session::has('navigation_title') && $request->title != Session::get('navigation_title')) {
                Session::forget('navigation_title');
            }

            if (Session::has('from_notification') && $request->title != Session::get('from_notification')) {
                Session::forget('from_notification');
            }

            if (isset($request->notification) && $request->notification == true) {
                Session::put('from_notification', $request->title);
            } else {
                Session::put('navigation_title', $request->title);
            }
        }
    }

    // Fet User List in Setting page
    public function userList(Request $request)
    {
        if ($request->ajax() && $request->has('sort')) {
            $sort  = explode('-', $request->sort);
            $users = User::orderBy($sort[0], $sort[1]);

            if (!empty($request->tenant_id) && user()->account_type == 1) {
                $users->where('tenant_id', '=', $request->tenant_id);
            } elseif (user()->account_type == 4) {
                $users->where('tenant_id', '=', tenant('tenant_id'));
            }

            if (!empty($request->keyword)) {
                $users->where('name', 'LIKE', '%' . $request->keyword . '%');
            }

            $users      = $users->get();
            $returnHTML = view('users.list', compact('users'))->render();

            return response()->json([
                'success' => true,
                'html'    => $returnHTML,
            ]);
        }
    }

    public function createUser()
    {
        return view('users.create');
    }

    public function validateUser(Request $request)
    {
        $err = [];

        // Name Validation
        if (empty($request->name)) {
            $err['name'] = __('Name is required');
        }
        // End Name Validation

        // Username Validation
        if (!empty($request->username)) {
            $username = User::where('tenant_id', tenant('tenant_id'))->where(
                'username',
                '=',
                $request->username
            )->first();

            if (!empty($username)) {
                $err['username'] = __('Username already exist in our records');
            }
        } else {
            $err['username'] = __('Username is required');
        }
        // End Username Validation

        // Email Validation
        if (!empty($request->email)) {
            $email = User::where('email', 'LIKE', $request->email)->first();
            if (!empty($email)) {
                $err['email'] = __('Email already exist in our records');
            }
        } else {
            $err['email'] = __('Email is required');
        }
        // End Email Validation

        if (count($err) > 0) {
            return response()->json([
                'is_success' => false,
                'errors'     => $err,
            ]);
        }

        return response()->json(['is_success' => true]);
    }

    public function storeUser(Request $request)
    {
        $objUser = user();

        if ($objUser->account_type == 4) {
            $validator = Validator::make($request->all(), [
                'name'     => 'required|max:120',
                'username' => 'required|max:120',
                'email'    => 'required|email|max:120|unique:users',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            // Username Validation
            if (isset($request->username)) {
                $username = User::where('tenant_id', tenant('tenant_id'))->where(
                    'username',
                    '=',
                    $request->username
                )->first();
                if (!empty($username)) {
                    return redirect()->back()->with('error', __('Username already exist in our records'));
                }
            }

            // End Username Validation

            $post                           = $request->all();
            $post['password']               = Hash::make('123456789');
            $post['username']               = $request->username;
            $post['tenant_id']              = tenant('tenant_id');
            //$post['tenant_contact_name']    = tenant()->user->name;
            //$post['tenant_contact_email']   = tenant()->user->email;
            $post['account_status']         = 'pending';
            $post['account_status_message'] = config('message.register_message');
            $post['created_by']             = $objUser->id;

            $user = User::create($post);

            if ($user) {
                // Make API Call Here for Registration
                $post['password'] = '123456789';
                $post['id']       = $user->id;

                $apiResp = Utility::makeRegistration($post);

                if ($apiResp['is_success'] == true) {
                    return redirect()->back()->with('success', __('User Created Successfully.'));
                }

                // Delete User if API Response is false
                $user->delete();

                return redirect()->back()->with('error', __('An error occurred attempting to create the user account.'));
            }

            return redirect()->back()->with('error', __('An error occurred attempting to create the user account.'));
        }

        return redirect()->back()->with('error', __('Permission Denied.'));
    }

    public function editUser(User $user) {
        $tenant = Tenant::where('tenant_id', $user->tenant_id)->first();
        return view('users.edit', compact('user', 'tenant'));
    }

    public function updateUser(Request $request, User $user)
    {

        $validate = [
            'name'  => 'required|max:120',
            'phone' => 'max:20',
        ];

        if (isset($request->avatar) && !empty($request->avatar)) {
            $validate = [
                'avatar' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        }

        $validator = Validator::make(
            $request->all(),
            $validate
        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $user->name           = $request->get('name');
        $user->phone          = $request->get('phone');
        $user->account_status = ($user->account_status == 'pending') ? $user->account_status : $request->get(
            'account_status'
        );
        $user->account_status_message = $request->get('account_status_message');
        $user->chat_user              = $request->has('chat_user') ? 1 : 0;
        $user->account_type           = $request->has('account_type') ? $request->get('account_type') : $user->account_type;

        if ($request->has('avatar')) {
            Utility::checkFileExistsNDelete([$user->avatar]);
            $user->avatar = Storage::disk()->put('avatars', $request->file('avatar'));
        }

        if ($user->save()) {
            if ($request->has('primary_contact')) {
                // if primary_contact is checked then save tenant primary_contact
                Tenant::where('tenant_id', tenant('tenant_id'))->update(['primary_contact' => $user->id]);
            }
        }

        return redirect()->back()->with('success', __('User updated successfully.'))->with('tab-status', 'user-layout');
    }

    public function validateUserEdit(Request $request, User $user)
    {
        $objUser = user();
        $logoutUser = false;


        $validate = [
            'name'  => 'required|max:120',
            'phone' => 'max:20',
        ];

        if (isset($request->avatar) && !empty($request->avatar)) {
            $validate = [
                'avatar' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        }

        $validator = Validator::make(
            $request->all(),
            $validate
        );

        if ($validator->fails()) {
            return response()->json([
                'is_success' => false,
                'validated'  => false,
                'errors'     =>  $validator->errors(),
            ]);
        }

        $user->tenant_id   = $request->get('selected_tenant_id');
        $user->name        = $request->get('name');
        $user->id          = $request->get('selected_user_id');
        $user->account_type = $request->has('account_type') ? $request->get('account_type') : $request->get('current_account_type') ;
        $user->old_account_type = $request->get('current_account_type');

        //Only admins can edit users
        if( $objUser->account_type == User::EXTERNAL_TENANT_ADMIN ||
            $objUser->account_type == User::INTERNAL_TENANT_ADMIN) {

            // If downgrading a user from admin to non-admin, do some checks
            if(($user->old_account_type == User::EXTERNAL_TENANT_ADMIN &&
                    $user->account_type == User::EXTERNAL_TENANT_USER)
                ||
                ($user->old_account_type == User::INTERNAL_TENANT_ADMIN &&
                $user->account_type == User::INTERNAL_TENANT_USER)) {

                // Make sure this tenant will still have at least 1 admin user after this change
                $adminCount = User::getTenantActiveAdminCount($user->tenant_id, $user->old_account_type);

                if(count($adminCount) <= 1)
                {
                    return response()->json([
                        'is_success' => false,
                        'validated'  => true,
                        'admin_count_details' =>$adminCount,
                        'admin_count' => count($adminCount),
                        'new account type' => $user->account_type,
                        'old_account_type' =>  $user->old_account_type,
                        'message'    => __('Cannot downgrade account. <br/> Tenant must have at least one active Admin account!'),
                    ]);
                }

                // If the current user is downgrading their own account, prompt & warn them
                if($objUser->id == $user->id)                {
                    return response()->json([
                        'is_success' => true,
                        'validated'  => true,
                        'logout' => true,
                        'prompt' => true,
                    ]);

                }else{
                    // not the current user
                    return response()->json([
                        'is_success' => true,
                        'validated'  => true,
                        'logout' => false,
                        'prompt' => false,
                        'message'    => __('Downgrading selected user account'),
                    ]);
                }
            }else{
                // Upgrading user's account
                return response()->json([
                    'is_success' => true,
                    'validated'  => true,
                    'logout' => false,
                    'prompt' => false,
                    'message'    => __('Upgrading selected user account or Same Account Type'),
                ]);
            }
        }else{
            //only admin can edit user changes
            return response()->json([
                'is_success' => false,
                'validated'  => false,
                'message'    => __('Only admin can edit user details'),
            ]);
        }

        $data        = [];
        $data['url'] = $request->session()->get('_previous');

        return response()->json([
            'is_success' => true,
            'data'       =>  $data,

            'message'    => __('Note added successfully.!'),
        ]);
    }

    // When user register then display modal
    public function firstTime()
    {
        if (user()->account_type == User::EXTERNAL_TENANT_ADMIN || user()->account_type == User::EXTERNAL_TENANT_USER) {
            return view('welcome_0');
        } elseif (user()->account_type == User::INTERNAL_TENANT_ADMIN || user()->account_type == User::INTERNAL_TENANT_USER) {
            return view('welcome_1');
        }

        return view('welcome_2');
    }

    public function getUsersToShare(Request $request)
    {
        $user         = user();
        $showAllUsers = $request->boolean('show_all_users', false);

        $users = User::where('id', '!=', $user->id);

        if ($user->account_type != User::INTERNAL_TENANT_ADMIN || $user->tenant_id !== 'host' || !$showAllUsers) {
            $users->where('tenant_id', tenant('tenant_id'));
        }

        // for some reason , account_type must included or else it throw error result undefine index
        // all custom attributes is included account_type,account_type_name,img_avatar,avatar
        $data = $users->select('name', 'username','tenant_id','account_type')->orderBy('tenant_id')->get();
        $result = [];
        foreach ($data as $index => $datum) {
            $result[$datum->username.'_'.$datum->tenant_id] = $datum->name .' ('.$datum->tenant_id.')';
        }
        return response()->json($result);
    }

    // Common Share View
    public function share($encodeArgOne, $argTwo, $type)
    {
        $argOne = Crypt::decryptString($encodeArgOne);
        if ($type == 'document') {
            return view('folders.share', compact('argOne', 'argTwo'));
        }

        return view('tasks.share', compact('argOne', 'argTwo'));
    }

    // Store Shared Document
    public function shareStore(Request $request, $type)
    {
        $validator = Validator::make($request->all(), [

            'users'   => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $usernames = [];
        if ($type == 'document') {
            foreach ($request->users as $user) {
                $data = explode('_', $user);
                $username = $data[0];
                $tenant_id = $data[1];
                UserNotification::create([
                    'username'   => $username,
                    'tenant_id'  => $tenant_id, //tenant_id was specified at getUsersToShare
                    'type' => 'fa-share-square',
                    'text'       => $request->message,
                    'scope'      => 'user',
                    'link_title' => 'Notification',
                    'link_color' => 'bg-primary',
                    'link_url'   => $request->app . '|' . $request->docId,
                    'link_type'  => 'doc',
                ]);
                $usernames[] = $username;
            }

            $currDateTime = Carbon::now()->toDateTimeString();
            user()->activities()->create([
                'type'         => 'shared-document',
                'date_time'    => $currDateTime,
                'text'         => 'Documents successfully shared to (' . implode(',', $usernames) . ') at ' . Utility::getDateFormatted($currDateTime, true),
                'reference_id' => $request->app . '|' . $request->docId,
            ]);
            return redirect()->back()->with('success', __('Document Shared Successfully!'));
        }

        foreach ($request->users as $user) {
            $data = explode('_', $user);
            $username = $data[0];
            $tenant_id = $data[1];
            UserNotification::create([
                'username'   => $username,
                'tenant_id'  => $tenant_id, //tenant_id was specified at getUsersToShare
                'type' => 'fa-share-square',
                'text'       => $request->message,
                'scope'      => 'user',
                'link_title' => 'Open work item',
                'link_color' => 'bg-primary',
                'link_url'   => $request->work_item . '|' . $request->batch_id,
                'link_type'  => 'batch',
            ]);
            $usernames[] = $username;
        }

        $currDateTime = Carbon::now()->toDateTimeString();
        user()->activities()->create([
            'type'         => 'shared-work-item',
            'date_time'    => $currDateTime,
            'text'         => 'Work Item successfully shared to (' . implode(',', $usernames) . ') at ' . Utility::getDateFormatted($currDateTime, true),
            'reference_id' => $request->work_item . '|' . $request->batch_id,
        ]);
        return redirect()->back()->with('success', __('Work item Shared Successfully!'));
    }

    // Add User Note
    public function addUserNote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'note'    => 'required|string',
            'batchId' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'is_success' => false,
                'message'    => $validator->errors()->first(),
            ]);
        }

        $note = Note::create([
            'batch_id'   => $request->batchId,
            'notes'      => $request->note,
            'created_by' => user()->id,
        ]);

        $note = [
            'date'  => Utility::getDateFormatted($note->created_at),
            'user'  => user()->name,
            'event' => $note->notes,
        ];

        return response()->json([
            'is_success' => true,
            'data'       => $note,
            'message'    => __('Note added successfully.!'),
        ]);
    }

    public function clearSearchDatumsFilter()
    {
        Session::forget('folderName');
        Session::forget('SearchDatums_lastFilter');
    }

}
