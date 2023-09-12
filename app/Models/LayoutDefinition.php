<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Session;

/**
 * App\Models\LayoutDefinition
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $user_group 1= Internal, 2= External, 3= Public
 * @property string|null $security_groups
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Layout[] $layouts
 * @property-read int|null $layouts_count
 * @method static \Database\Factories\LayoutDefinitionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutDefinition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutDefinition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutDefinition query()
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutDefinition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutDefinition whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutDefinition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutDefinition whereSecurityGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutDefinition whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutDefinition whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutDefinition whereUserGroup($value)
 * @mixin \Eloquent
 */
/**
 * @SuppressWarnings(PHPMD)
 */
class LayoutDefinition extends Model
{
    use HasFactory;

    protected $table = 'layout_definitions';

    protected $fillable = [
        'title',
        'description',
        'user_group',
        'security_groups',
        'fixed_layout',
        'top_card_height',
        'middle_card_height',
        'bottom_card_height',
        'navigation_layout'
    ];

    public const USER_GROUP_INTERNAL = 0;
    public const USER_GROUP_EXTERNAL = 1;
    public const USER_GROUP_PUBLIC   = 2;

    public const USER_GROUPS = [
        self::USER_GROUP_INTERNAL => 1,
        self::USER_GROUP_EXTERNAL => 2,
        self::USER_GROUP_PUBLIC   => 3,
    ];

    public const NAVIGATION_LAYOUT_GRID = 'grid';
    public const NAVIGATION_LAYOUT_LIST = 'list';

    public const NAVIGATION_LAYOUTS = [
        self::NAVIGATION_LAYOUT_GRID => 'grid',
        self::NAVIGATION_LAYOUT_LIST => 'list',
    ];

    public const USER_GROUP_NAMES = [
        1 => "Internal",
        2 => "External",
    ];

    public function getIsCurrentLayoutAttribute(): bool
    {
        return $this->is(user()?->layoutDefinition);
    }

    public function layouts(): HasMany
    {
        return $this->hasMany(Layout::class, 'layout_definition_id', 'id');
    }

    public static function showLayout(): bool
    {
        return true;
    }

    public static function layoutDefinitions()
    {
        $objUser    = user();
        $usrData    = Session::get('userInfo');
        $userGroups = $usrData->UserGroups ?? '';

        $userGroup = self::getUserGroupByAccountType($objUser->account_type);

        $definitions = LayoutDefinition::query()
            ->where('user_group', '=', $userGroup)
            ->get();

        foreach ($definitions as $key => $value) {
            $securityGroups = $value->security_groups;

            if ($securityGroups != "" && $securityGroups != null && $securityGroups != "null") {
                $arrayIntersectData = array_intersect(json_decode($securityGroups), $userGroups);
                if (count($arrayIntersectData) == 0) {
                    unset($definitions[$key]);
                }
            }
        }

        return $definitions->pluck('title', 'id');
    }

    private static function getUserGroupByAccountType(int $accountType): int
    {
        if ($accountType == User::INTERNAL_TENANT_ADMIN || $accountType == self::USER_GROUP_PUBLIC) {
            return 1;
        } elseif ($accountType == User::EXTERNAL_TENANT_USER || $accountType == User::EXTERNAL_TENANT_ADMIN) {
            return 2;
        }
        // elseif ($accountType == User::PUBLIC_CLIENT) {
        //     return 3;
        // }

        return 0;
    }
}
