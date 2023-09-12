<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\Notification\NotificationStoreRequest;
use App\Models\User;
use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserNotificationController extends Controller
{
    public $TENANT_HOST = "host";
    public $TENANT_ALL  = "all";
    public $ALL_USERID  = 0;

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

        $notifications = UserNotification::orWhere(function (Builder $query) {
            return $query->where('username', user()->username)
                ->where('tenant_id', user()->tenant_id)
                ->where('scope', 'user');
        })
            ->orWhere(function (Builder $query) {
                return $query->where('tenant_id', user()->tenant_id)
                    ->where('scope', 'tenant');
            })
            ->orWhere(function (Builder $query) {
                return $query->where('scope', 'system');
            })
            ->orderBy('created_at', $orderBy)
            ->limit(300)
            ->get();

        return view('notification.index', compact('notifications'));
    }

    public function markNotification()
    {
        if (Auth::check()) {
            user()->update(['notifications_read' => Carbon::now()->toDateTimeString()]);
            return redirect()->back()->with('success', __('Mark all notifications as read successfully.'));
        }

        return redirect()->back()->with('error', __('Permission Denied.'));
    }

    public function markAsRead(UserNotification $userNotification)
    {
        return response()->json([
            'is_success' => "true",
            'message'    => __('Mark as read successfully.'),
        ]);
    }

    public function addNotification(NotificationStoreRequest $request): JsonResponse
    {
        $post = $request->validated();

        $username = $post['username'];
        $scope    = $post['scope'];
        $tenant_id = $post['tenant_id'] ?? null;

        if (strcasecmp($scope, "system") == 0) {
            //for all system notifications
            return response()->json($this->createNotificationAllUsers($post));
        }

        if (strcasecmp($scope, "tenant") == 0) {
            //for all tenant notifications
            if ($tenant_id) {
                return response()->json($this->createNotificationAllUsersTenant($tenant_id, $post));
            } else {
                //missing tenant_id || null
                return response()->json([
                    'is_success' => "false",
                    'message'    => __('Incorrect tenant_id at username parameter. Please refer to proper format.'),
                ]);
            }
        }

        if (strcasecmp($scope, "user") == 0) {
            //notification for <tenant_id> : <username>
            if (Str::contains($username, ':')) {
                $username_pieces = explode(":", $username);
                $tenant_id       = $username_pieces[0];
                $user_name       = $username_pieces[1];

                return response()->json($this->createNotificationForTenantUsername($tenant_id, $user_name, $post));

            } else if (!empty($username)) {
                //notification for <username>
                return response()->json([
                    'is_success' => "true",
                    'message'    => __('Notification Added Successfully to user.'),
                    'data'       => UserNotification::create(array_merge($post, [
                        'username'  => $username,
                        'tenant_id' => "host",
                        'scope'     => "user",
                    ])),
                ]);
            } else {
                //username is empty or a missing
                return response()->json([
                    'is_success' => "false",
                    'message'    => __('Incorrect tenant_id at username parameter. Please refer to proper format.'),
                ]);
            }
        }

    }

    private function createNotificationForTenantUsername(string $tenantId, string $username, array $post): array
    {
        $notifications = UserNotification::create(
            array_merge($post, [
                'tenant_id' => $tenantId,
                'username'  => $username,
                'scope'     => 'user',
            ])
        );

        return [
            'is_success' => "true",
            'message'    => __('Notification Added Successfully to user.'),
            'data'       => $notifications,
        ];
    }

    private function createNotificationAllUsers(array $post): array
    {
        $notifications = UserNotification::create(
            array_merge($post, [
                'scope'     => 'system',
                'username'  => null,
                'tenant_id' => null,
            ])
        );

        return [
            'is_success' => "true",
            'message'    => __('Notification Added Successfully to all system users.'),
            'data'       => $notifications,
        ];
    }

    private function createNotificationAllUsersTenant(string $tenantId, array $post): array
    {
        $notifications = UserNotification::create(
            array_merge($post, [
                'tenant_id' => $tenantId,
                'scope'     => 'tenant',
                'username'  => null,
            ])
        );

        return [
            'is_success' => "true",
            'message'    => __('Notification Added Successfully to all tenant users.'),
            'data'       => $notifications,
        ];
    }
}
