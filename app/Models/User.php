<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $avatar
 * @property string $lang
 * @property int $created_by
 * @property int $account_type 0 = customer/client, 1 = internal admin, 2 = internal non-admin, 3 = public, 4 = external admin
 * @property string $account_status
 * @property string|null $account_status_message
 * @property int $chat_user
 * @property string|null $last_login_at
 * @property string|null $password_change_at
 * @property string|null $phone
 * @property string|null $notifications_read
 * @property string|null $communication_channel
 * @property string|null $texting_number
 * @property string|null $tenant_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $messenger_color
 * @property int $dark_mode
 * @property int $active_status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Call[] $calls
 * @property-read int|null $calls_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ChFavorite[] $chFavorites
 * @property-read int|null $ch_favorites_count
 * @property-read string $img_avatar
 * @property-read \App\Models\LayoutDefinition|null $layoutDefinition
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Tenant|null $tenant
 * @property int|mixed|string $layout_definition
 * @property mixed $calendar
 * @method static Builder|User avatar(string $avatar)
 * @method static Builder|User darkMode()
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User lightMode()
 * @method static Builder|User messengerColor(string $messengerColor)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereAccountStatus($value)
 * @method static Builder|User whereAccountStatusMessage($value)
 * @method static Builder|User whereAccountType($value)
 * @method static Builder|User whereActiveStatus($value)
 * @method static Builder|User whereAvatar($value)
 * @method static Builder|User whereChatUser($value)
 * @method static Builder|User whereCommunicationChannel($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereCreatedBy($value)
 * @method static Builder|User whereDarkMode($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLang($value)
 * @method static Builder|User whereLastLoginAt($value)
 * @method static Builder|User whereMessengerColor($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereNotificationsRead($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePasswordChangeAt($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereTenantId($value)
 * @method static Builder|User whereTextingNumber($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, HasFactory;

    public const EXTERNAL_TENANT_USER  = 0;
    public const INTERNAL_TENANT_ADMIN = 1;
    public const INTERNAL_TENANT_USER  = 2;
    public const EXTERNAL_TENANT_ADMIN = 4;
     public const PUBLIC_CLIENT         = 3;


    public const EXTERNAL_ACCOUNT_TYPES = [
        self::EXTERNAL_TENANT_USER  => 'User',
        self::EXTERNAL_TENANT_ADMIN => 'Admin',
    ];

    public const INTERNAL_ACCOUNT_TYPES = [
        self::INTERNAL_TENANT_ADMIN => 'Admin',
        self::INTERNAL_TENANT_USER  => 'User',
    ];

    public const ACCOUNT_TYPES = [
        self::EXTERNAL_TENANT_USER  => 'User',
        self::INTERNAL_TENANT_ADMIN => 'Admin',
        self::INTERNAL_TENANT_USER  => 'User',
        self::PUBLIC_CLIENT         => 'Public Client',
        self::EXTERNAL_TENANT_ADMIN => 'Admin',
    ];

    public const ILINX_USER_TYPE = 'BuiltIn';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'lang',
        'created_by',
        'account_type',
        'account_status',
        'account_status_message',
        'chat_user',
        'last_login_at',
        'password_change_at',
        'phone',
        'notifications_read',
        'communication_channel',
        'texting_number',
        'layout_definition',
        'is_active',
        'tenant_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at'  => 'datetime',
        'notifications_read' => 'datetime',
        'last_login_at'      => 'datetime',
    ];

    // Change image while fetching
    protected $appends = ['img_avatar', 'account_type_name'];

    public function getImgAvatarAttribute(): string
    {
        if (\Storage::exists($this->avatar ?? "") && !empty($this->avatar)) {
            return $this->attributes['img_avatar'] = 'src=' . asset(\Storage::url($this->avatar));
        }

        return $this->attributes['img_avatar'] = 'avatar=' . $this->name;
    }

    public function getAccountTypeNameAttribute(): string
    {
        return self::ACCOUNT_TYPES[$this->account_type];
    }

    public function getMaskedEmailAttribute(): string
    {
        $atPositionWithoutOffset = strpos($this->email, '@') - 2;

        return Str::substrReplace($this->email, str_repeat('*', $atPositionWithoutOffset), 2, $atPositionWithoutOffset);
    }

    public function getNotification()
    {
        $notifications = UserNotification::orWhere(function (Builder $query) {
            return $query->where('username', $this->username)
                ->where('tenant_id', $this->tenant_id)
                ->where('scope', 'user');
        })
            ->orWhere(function (Builder $query) {
                return $query->where('tenant_id', $this->tenant_id)
                    ->where('scope', 'tenant');
            })
            ->orWhere(function (Builder $query) {
                return $query->where('scope', 'system');
            })
            ->orderBy('created_at', 'DESC')
            ->get();

        return $notifications;
    }

    public function getUnreadNotification()
    {
        if ($this->notifications_read) {
            $notifications = UserNotification::where('created_at', '>', $this->notifications_read)
                ->where(function (Builder $query) {
                    return $query->orWhere(function (Builder $q1) {
                        return $q1->where('username', $this->username)
                            ->where('tenant_id', $this->tenant_id)
                            ->where('scope', 'user');
                    })
                        ->orWhere(function (Builder $q2) {
                            return $q2->where('tenant_id', $this->tenant_id)
                                ->where('scope', 'tenant');
                        })
                        ->orWhere(function (Builder $q3) {
                            return $q3->where('scope', 'system');
                        });
                })
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            $notifications = UserNotification::where(function (Builder $query) {
                return $query->orWhere(function (Builder $q1) {
                    return $q1->where('username', $this->username)
                        ->where('tenant_id', $this->tenant_id)
                        ->where('scope', 'user');
                })
                    ->orWhere(function (Builder $q2) {
                        return $q2->where('tenant_id', $this->tenant_id)
                            ->where('scope', 'tenant');
                    })
                    ->orWhere(function (Builder $q3) {
                        return $q3->where('scope', 'system');
                    });
            })
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        return $notifications;
    }

    public static function getTenantActiveAdminCount($tenant_id, $account_type){
        $activeAccounts = User::where('tenant_id', '=', $tenant_id)
        ->where('account_type','=', $account_type)
        ->where('account_status', 'active')
        ->get();

        return $activeAccounts;
    }

    public function userRole()
    {
        if ($this->account_type == 0) {
            return __('Custom/Client'); // External User
        } elseif ($this->account_type == 1) {
            return __('Internal Admin'); // Admin User (Internal Admin)
        } elseif ($this->account_type == 2) {
            return __('Internal User'); // Non-Admin User (Internal User)
        } elseif ($this->account_type == 3) {
            return __('Public'); // Public
        } elseif ($this->account_type == 4) {
            return __('External Admin'); // Admin User (External Admin)
        }
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function layoutDefinition(): HasOne
    {
        return $this->hasOne(LayoutDefinition::class, 'id', 'layout_definition');
    }

    public function scopeDarkMode(Builder $query): int
    {
        return $query->update(['dark_mode' => 1]);
    }

    public function scopeLightMode(Builder $query): int
    {
        return $query->update(['dark_mode' => 0]);
    }

    public function scopeMessengerColor(Builder $query, string $messengerColor): int
    {
        return $query->update(['messenger_color' => $messengerColor]);
    }

    public function scopeAvatar(Builder $query, string $avatar): int
    {
        return $query->update(['avatar' => $avatar]);
    }

    public function calls()
    {
        return $this->hasMany(Call::class);
    }

    public function chFavorites()
    {
        return $this->hasMany(ChFavorite::class);
    }

    public function chFavorite()
    {
        return $this->hasOne(ChFavorite::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'user_id', 'id');
    }

    public function irdTimeTracks()
    {
        return $this->hasMany(IrdTimeTracking::class, 'created_by', 'id');
    }

    public function hasUpdatePassword(): bool
    {
        return $this->attributes["password_change_at"] != null;
    }

    public function calendar(): HasMany
    {
        return $this->hasMany(Calendar::class, 'created_by', 'id');
    }

    public function twoFactorAuthenticationCode(): HasOne
    {
        return $this->hasOne(TwoFactorAuthenticationCode::class);
    }
}
