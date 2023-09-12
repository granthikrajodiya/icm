<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\RestIntegration
 *
 * @property int $id
 * @property int $parent_id 0 for authentication integration, others are child configuration such as search/list configuration and opening document configuration
 * @property string $name
 * @property string $rest_endpoint_url
 * @property string $http_method
 * @property int $http_authentication 0 means on and 1 means off
 * @property string|null $http_username
 * @property string|null $http_password
 * @property int $custom_http_headers 0 means on and 1 means off
 * @property string|null $http_headers
 * @property int $data_format 0 means Send Key-Value Pairs and 1 means Send Raw Data
 * @property string|null $data_parameter
 * @property string|null $result_list
 * @property int $integration_type 0 means authentication integration, 1 search/list configuration, 2 means opening document configuration
 * @property string|null $basic_details
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $details_type 0 means no details, 1 means basic details, 2 open document
 * @property-read \Illuminate\Database\Eloquent\Collection|RestIntegration[] $childRestCall
 * @property-read int|null $child_rest_call_count
 * @property-read \App\Models\User|null $createdBy
 * @property-read RestIntegration|null $parentRestCall
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\RestIntegrationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration query()
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereBasicDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereCustomHttpHeaders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereDataFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereDataParameter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereDetailsType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereHttpAuthentication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereHttpHeaders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereHttpMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereHttpPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereHttpUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereIntegrationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereRestEndpointUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereResultList($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RestIntegration whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RestIntegration extends Model
{
    use CreatedBy, HasFactory;

    protected $table = 'rest_integrations';

    protected $fillable = [
        'name',
        'rest_endpoint_url',
        'http_method',
        'http_authentication',
        'http_username',
        'http_password',
        'custom_http_headers',
        'http_headers',
        'data_format',
        'data_parameter',
        'result_list',
        'integration_type',
        'basic_details',
        'details_type',
        'created_by',
        'parent_id',
    ];

    public const PARENT_INTEGRATION_AUTH  = 0;
    public const PARENT_INTEGRATION_OTHER = 1;

    public const PARENTS_INTEGRATION = [
        self::PARENT_INTEGRATION_AUTH  => 0,
        self::PARENT_INTEGRATION_OTHER => 1,
    ];

    public const HTTP_AUTH_ON  = 0;
    public const HTTP_AUTH_OFF = 1;

    public const HTTP_AUTH = [
        self::HTTP_AUTH_ON  => 0,
        self::HTTP_AUTH_OFF => 1,
    ];

    public const CUSTOM_HTTP_HEADER_ON  = 0;
    public const CUSTOM_HTTP_HEADER_OFF = 1;

    public const CUSTOM_HTTP_HEADER = [
        self::CUSTOM_HTTP_HEADER_ON  => 0,
        self::CUSTOM_HTTP_HEADER_OFF => 1,
    ];

    public const DATA_FORMAT_KEY_VALUE = 0;
    public const DATA_FORMAT_RAW_DATA  = 1;

    public const DATA_FORMATS = [
        self::DATA_FORMAT_KEY_VALUE => 0,
        self::DATA_FORMAT_RAW_DATA  => 1,
    ];

    public const INTEGRATION_TYPE_AUTH   = 0;
    public const INTEGRATION_TYPE_SEARCH = 1;
    public const INTEGRATION_TYPE_OPEN   = 2;

    public const INTEGRATION_TYPES = [
        self::INTEGRATION_TYPE_AUTH   => 0,
        self::INTEGRATION_TYPE_SEARCH => 1,
        self::INTEGRATION_TYPE_OPEN   => 2,
    ];

    public const DETAIL_TYPE_NO_DETAIL    = 0;
    public const DETAIL_TYPE_BASIC_DETAIL = 1;
    public const DETAIL_TYPE_OPEN_DOC     = 2;

    public const DETAIL_TYPES = [
        self::DETAIL_TYPE_NO_DETAIL    => 0,
        self::DETAIL_TYPE_BASIC_DETAIL => 1,
        self::DETAIL_TYPE_OPEN_DOC     => 2,
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function parentRestCall(): HasOne
    {
        return $this->hasOne('App\Models\RestIntegration', 'id', 'parent_id');
    }

    public function childRestCall(): HasMany
    {
        return $this->hasMany('App\Models\RestIntegration', 'parent_id', 'id');
    }

    public static function fetchIntegration()
    {
        $integrations = self::where(['parent_id' => 0, 'integration_type' => 1, 'created_by' => user()->id])->get()->pluck('id', 'name');

        return $integrations;
    }
}
