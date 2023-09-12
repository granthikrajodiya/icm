<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Calendar
 *
 * @property int $id
 * @property string $name
 * @property string|null $username
 * @property string|null $tenant_id
 * @property string $scope
 * @property int|null $all_day
 * @property string|null $timezone
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string $start_date
 * @property string $end_date
 * @property string|null $description
 * @property string $color
 * @property int $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\User|null $createdBy
 * @property-read Carbon $end_date_time
 * @property-read Carbon $start_date_time
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\CalendarFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar filterAccountType(\App\Models\User $user)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar query()
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Calendar extends Model
{
    use CreatedBy, HasFactory;

    protected $fillable = [
        'name',
        'username',
        'tenant_id',
        'scope',
        'all_day',
        'timezone',
        'start_time',
        'end_time',
        'start_date',
        'end_date',
        'description',
        'color',
        'created_by',
    ];

    public const USER   = 0;
    public const TENANT = 1;
    public const SYSTEM = 2;


    public const BG_SUCCESS = 0;
    public const BG_PRIMARY = 1;
    public const BG_INFO    = 2;
    public const BG_WARNING = 3;
    public const BG_DANGER  = 4;

    public const SCOPE_TYPES  = [
        self::USER   => 'user',
        self::TENANT => 'tenant',
        self::SYSTEM => 'system',
    ];

    public const COLORS = [
        self::BG_SUCCESS => 'bg-success',
        self::BG_PRIMARY => 'bg-primary',
        self::BG_INFO    => 'bg-info',
        self::BG_WARNING => 'bg-warning',
        self::BG_DANGER  => 'bg-danger',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function scopeFilterAccountType($query, User $user)
    {
        $calendar =  Calendar::orWhere( function ( Builder $query) use ($user) {
                return $query->where('username', $user->username)
                    ->where('tenant_id', $user->tenant_id)
                    ->where('scope', Calendar::SCOPE_TYPES[Calendar::USER]);
            })
            ->orWhere(function (Builder $query) use ($user) {
                return $query->where('tenant_id', $user->tenant_id)
                    ->where('scope', Calendar::SCOPE_TYPES[Calendar::TENANT]);
            })
            ->orWhere(function (Builder $query) {
                return $query->where('scope',  Calendar::SCOPE_TYPES[Calendar::SYSTEM]);
            });

            return $calendar;
    }


    public static function getCalendarName($value)
    {
        $cal = Calendar::find($value);
        if ($cal) {
            return $cal->name;
        } else {
            return "Event Details";
        }
    }

    public function getStartTimeAttribute($value): string
    {
        return $this->formatTime($value);
    }

    public function getEndTimeAttribute($value): string
    {
        return $this->formatTime($value);
    }

    public function getStartDateTimeAttribute(): Carbon
    {
        if (is_numeric(substr($this->start_date, 0, 2))) {
            $date = Carbon::parse($this->start_date);
        } else {
            $date = Carbon::createFromFormat('M d Y H:i:s:a', $this->start_date);
        }

        if (is_numeric(substr($this->start_time, 0, 2))) {
            $time = Carbon::parse($this->start_time);
        } else {
            $time = Carbon::createFromFormat('M d Y H:i:s:a', $this->start_time);
        }

        $dateTime = $date->format('Y-m-d') . " " . $time->format('H:i:s');

        return Carbon::createFromFormat('Y-m-d H:i:s', $dateTime, $this->timezone);
    }

    public function getEndDateTimeAttribute(): Carbon
    {
        if (is_numeric(substr($this->end_date, 0, 2))) {
            $date = Carbon::parse($this->end_date);
        } else {
            $date = Carbon::createFromFormat('M d Y H:i:s:a', $this->end_date);
        }

        if (is_numeric(substr($this->end_time, 0, 2))) {
            $time = Carbon::parse($this->end_time);
        } else {
            $time = Carbon::createFromFormat('M d Y H:i:s:a', $this->end_time);
        }

        $dateTime = $date->format('Y-m-d') . " " . $time->format('H:i:s');

        return Carbon::createFromFormat('Y-m-d H:i:s', $dateTime, $this->timezone);
    }

    public function scopeAllTenant(Builder $query): Builder
    {
        return $query->where('tenant_id', user()->tenant_id)
            ->orWhere('scope', 'system');
    }

    public function scopeAllTenantUser(Builder $query): Builder
    {
        return $query->where('username', user()->username)
            ->orWhere('tenant_id', user()->tenant_id)
            ->orWhere('scope', 'system');
    }

    private function formatTime($value)
    {
        if (substr($value, 2, 1) == ":") {
            $time = Carbon::createFromFormat('H:i:s', substr($value, 0, 8));
        } else {
            if (is_numeric(substr($value, 0, 2))) {
                $time = Carbon::parse($value);
            } else {
                if (empty($value)) {
                    return "00:00:00";
                }

                $time = Carbon::createFromFormat('M d Y H:i:s:a', $value);
            }
        }

        if ($time instanceof Carbon) {
            return $time->format("H:i:s");
        }

        return "00:00:00";
    }
}
