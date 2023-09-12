<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserNotification
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $type
 * @property string $date_time
 * @property string|null $text
 * @property int $is_read
 * @property string|null $link_title
 * @property string|null $link_color
 * @property string|null $link_url
 * @property string|null $link_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereDateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereLinkColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereLinkTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereLinkType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereLinkUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereUserId($value)
 * @mixin \Eloquent
 */
class UserNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'text',
        'link_title',
        'link_color',
        'link_url',
        'link_type',
        'username',
        'tenant_id',
        'scope',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public const SCOPE_USER   = 0;
    public const SCOPE_TENANT = 1;
    public const SCOPE_SYSTEM = 2;

    public const SCOPES = [
        self::SCOPE_USER   => 'user',
        self::SCOPE_TENANT => 'tenant',
        self::SCOPE_SYSTEM => 'system',
    ];

    public static function getLink($notification)
    {
        $link             = '#';
        $userNotification = UserNotification::find($notification->id ?? $notification);

        $arrUrl = explode('|', $userNotification->link_url ?? "");

        if ($userNotification->link_type == 'doc') {
            $link = route('folder.detail', [
                tenant('tenant_id'),
                rawurlencode($userNotification->link_title . '~Document'),
                rawurlencode($arrUrl[0]),
                $arrUrl[1],
                'notification',
            ]);
        } elseif ($userNotification->link_type == 'batch') {
            $link = route('tasks.detail', [
                tenant('tenant_id'),
                rawurlencode($userNotification->link_title),
                rawurlencode($arrUrl[0]),
                $arrUrl[1],
            ]);
        } elseif ($userNotification->link_type == 'batchform') {
            $link = route('tasks.eform.detail', [
                tenant('tenant_id'),
                rawurlencode($userNotification->link_title),
                rawurlencode($arrUrl[0]),
                $arrUrl[1],
            ]);
        } elseif ($userNotification->link_type == 'newform') {
            $link = route('forms.view', [
                tenant('tenant_id'),
                $arrUrl[1],
            ]);
        } elseif ($userNotification->link_type == 'calendar') {
            $link = route('calendar.show', [
                tenant('tenant_id'),
                $arrUrl[0],
            ]);
        }

        return $link;
    }
}
