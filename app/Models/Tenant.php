<?php

namespace App\Models;

use App\Events\Models\Tenant\Saved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

/**
 * App\Models\Tenant
 *
 * @property int $id
 * @property string $tenant_id
 * @property string $company_name
 * @property string $company_phone
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip
 * @property int $account_status 1 = Active, 0 = Deactive
 * @property string|null $message
 * @property int|null $primary_contact
 * @property bool $require_two_factor_authentication
 * @property string|null $logo
 * @property string|null $banner_type
 * @property string|null $banner
 * @property string|null $header_text
 * @property string|null $default_theme
 * @property string|null $date_format
 * @property string|null $day_start
 * @property int $show_activities
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $data
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stancl\Tenancy\Database\Models\Domain[] $domains
 * @property-read int|null $domains_count
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Stancl\Tenancy\Database\TenantCollection|static[] all($columns = ['*'])
 * @method static \Database\Factories\TenantFactory factory(...$parameters)
 * @method static \Stancl\Tenancy\Database\TenantCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereAccountStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereBannerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereCompanyPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereDateFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereDayStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereDefaultTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereHeaderText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant wherePrimaryContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereShowActivities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant whereZip($value)
 * @mixin \Eloquent
 */
class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'tenant_id',
        'company_name',
        'company_phone',
        'address',
        'city',
        'state',
        'zip',
        'account_status',
        'message',
        'primary_contact',
        'require_two_factor_authentication',
        'data',
        'logo',
        'banner_type',
        'banner',
        'header_text',
        'default_theme',
        'date_format',
        'day_start',
        'show_activities',
        'authentication_service',
        'branding_level',
        'small_logo',
        'manage_news_posts',
        'user_register'
    ];

    protected $dispatchesEvents = [
        'saved' => Saved::class,
    ];

    public const TENANT_ACTIVE   = 1;
    public const TENANT_INACTIVE = 0;

    public static $status = [
        '1' => 'Active',
        '0' => 'Inactive',
    ];

    public const BRANDING_LEVEL_ALL = 'all';
    public const BRANDING_LEVEL_MIN  = 'min';
    public const BRANDING_LEVEL_NONE  = 'none';
    public const BRANDING_LEVEL = [
        self::BRANDING_LEVEL_ALL => "All",
        self::BRANDING_LEVEL_MIN  => "Minimum",
        self::BRANDING_LEVEL_NONE  => "None",
    ];

    public const AUTH_SERVICE_ILINX = 'ilinx';
    public const AUTH_SERVICE_OKTA  = 'sso_okta';
    public const AUTH_SERVICE_AAD  = 'sso_aad';

    public const AUTH_SERVICES = [
        self::AUTH_SERVICE_ILINX => "ILINX",
        self::AUTH_SERVICE_OKTA  => "Okta",
        self::AUTH_SERVICE_AAD  => "Microsoft Azure Active Directory (AA)",
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'primary_contact');
    }

    public function ssoConfiguration(): HasOne
    {
        return $this->hasOne(SsoConfiguration::class, 'tenant_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'tenant_id', 'tenant_id');
    }

    /*
     * when you change primary field and get record by different field
     * in my case primary field is 'id' and in url we set 'tenant_id' field
     */
    public function getTenantKeyName(): string
    {
        return 'tenant_id';
    }

    public static function getCustomColumns(): array
    {
        return [
            'tenant_id',
            'company_name',
            'company_phone',
            'address',
            'city',
            'state',
            'zip',
            'account_status',
            'message',
            'primary_contact',
            'require_two_factor_authentication',
            'created_at',
            'updated_at',
            'data',
            'logo',
            'banner_type',
            'banner',
            'header_text',
            'default_theme',
            'date_format',
            'day_start',
            'show_activities',
            'authentication_service',
            'branding_level',
            'small_logo',
            'manage_news_posts',
            'user_register'
        ];
    }
    public function getIncrementing()
    {
        return true;
    }

    public function getUserOwner(): ?User
    {
        return User::where('tenant_id', '=', $this->tenant_id)
           ->oldest()
           ->first();
    }

    public function getLogoPathAttribute(): string
    {
        return asset(Storage::url($this->logo));
    }

    public function getBannerPathAttribute(): string
    {
        return asset(Storage::url($this->banner));
    }

    public function getFavIconPathAttribute(): string
    {
		// Only one favicon for the entire site
        return asset(Storage::url('logo' . '/favicon.ico'));
    }
}
