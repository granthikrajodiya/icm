<?php

namespace App\Actions;

// @codingStandardsIgnoreStart
class GetCalendarFormattedData
{
    public static function execute($calendars): array
    {
        return $calendars->map(function ($calendar) {
            $startDateTime = $calendar->startDateTime->toIso8601String();
            $endDateTime   = $calendar->endDateTime->toIso8601String();

            return [
                "id"          => $calendar->id,
                "title"       => $calendar->name,
                "start"       => $startDateTime,
                "end"         => $endDateTime,
                "allDay"      => $calendar->all_day == 0 ? false : true,
                "className"   => $calendar->color,
                "description" => $calendar->description,
                "timezone"    => $calendar->timezone,
                "url"         => route('calendar.show', [
                    tenant('tenant_id'),
                    $calendar->id,
                ]),
                "resize_url" => route('calendar.drag', [
                    tenant('tenant_id'),
                    $calendar->id,
                ]),
            ];
        })->toArray();
    }
}
// @codingStandardsIgnoreEnd
