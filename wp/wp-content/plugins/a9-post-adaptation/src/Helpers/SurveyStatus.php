<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Helpers;

final class SurveyStatus
{
    /**
     * Return survey status.
     */
    public static function get(int $postId): array
    {
        $start = (string) get_post_meta(
            $postId,
            'a9_start_datetime',
            true
        );

        $end = (string) get_post_meta(
            $postId,
            'a9_end_datetime',
            true
        );

        if ($start === '' || $end === '') {
            return self::emptyResponse($start, $end);
        }

        $startTimestamp = strtotime($start);
        $endTimestamp   = strtotime($end);
        $now            = current_time('timestamp');

        if (! $startTimestamp || ! $endTimestamp) {
            return self::emptyResponse($start, $end);
        }

        $status = 'live';
        $label = 'Live';
        $icon = '🟢';
        $color = 'green';

        if ($now < $startTimestamp) {

            $status = 'upcoming';
            $label = 'Upcoming';
            $icon = '🟡';
            $color = 'yellow';
        } elseif ($now > $endTimestamp) {

            $status = 'expired';
            $label = 'Expired';
            $icon = '🔴';
            $color = 'red';
        }

        $totalDuration = max(
            1,
            $endTimestamp - $startTimestamp
        );

        $elapsedDuration = max(
            0,
            min(
                $totalDuration,
                $now - $startTimestamp
            )
        );

        $remainingDuration = max(
            0,
            $endTimestamp - $now
        );

        $elapsedPercent = max(
            0,
            min(
                100,
                (int) round(
                    ($elapsedDuration / $totalDuration) * 100
                )
            )
        );

        $remainingPercent = max(0, 100 - $elapsedPercent);

        $startsIn = $status === 'upcoming'
            ? 100
            : 0;

        $endsIn = match ($status) {
            'live' => $remainingPercent,
            'upcoming' => 100,
            default => 0,
        };

        $message = self::buildMessage(
            $status,
            $now,
            $startTimestamp,
            $endTimestamp
        );

        return [
            'status' => [
                'code' => $status,
                'label' => $label,
                'message' => $message,
                'icon' => $icon,
                'color' => $color,
            ],

            'progress' => [
                'elapsed' => $elapsedPercent,
                'remaining' => $remainingPercent,
                'starts_in' => $startsIn,
                'ends_in' => $endsIn,
            ],

            'duration' => [
                'total' => $totalDuration,
                'elapsed' => $elapsedDuration,
                'remaining' => $remainingDuration,
            ],

            'start' => [
                'datetime' => $start,
                'timestamp' => $startTimestamp,
            ],

            'end' => [
                'datetime' => $end,
                'timestamp' => $endTimestamp,
            ],

            'is_live' => $status === 'live',
            'is_upcoming' => $status === 'upcoming',
            'is_expired' => $status === 'expired',
            'has_schedule' => true,
            'can_take_survey' => $status === 'live',
            'is_starting_soon' => (
                $status === 'upcoming'
                && ($startTimestamp - $now) <= DAY_IN_SECONDS
            ),
            'is_ending_soon' => (
                $status === 'live'
                && ($endTimestamp - $now) <= DAY_IN_SECONDS
            ),
        ];
    }

    /**
     * Empty response.
     */
    private static function emptyResponse(
        string $start,
        string $end
    ): array {
        return [
            'status' => [
                'code' => 'none',
                'label' => 'No Schedule',
                'message' => '',
                'icon' => '⚪',
                'color' => 'gray',
            ],

            'progress' => [
                'elapsed' => 0,
                'remaining' => 100,
                'starts_in' => 100,
                'ends_in' => 100,
            ],

            'duration' => [
                'total' => 0,
                'elapsed' => 0,
                'remaining' => 0,
            ],

            'start' => [
                'datetime' => $start,
                'timestamp' => null,
            ],

            'end' => [
                'datetime' => $end,
                'timestamp' => null,
            ],

            'is_live' => false,
            'is_upcoming' => false,
            'is_expired' => false,
            'has_schedule' => false,
            'can_take_survey' => true,
            'is_starting_soon' => false,
            'is_ending_soon' => false,
        ];
    }

    /**
     * Build survey message.
     */
    private static function buildMessage(
        string $status,
        int $now,
        int $start,
        int $end
    ): string {

        return match ($status) {

            'upcoming' => sprintf(
                __('Starts in %s', 'a9-post-adaptation'),
                self::formatDifference($start - $now)
            ),

            'expired' => sprintf(
                __('Expired %s ago', 'a9-post-adaptation'),
                self::formatDifference($now - $end)
            ),

            default => sprintf(
                __('Ends in %s', 'a9-post-adaptation'),
                self::formatDifference($end - $now)
            ),
        };
    }

    /**
     * Human readable duration.
     */
    private static function formatDifference(
        int $seconds
    ): string {

        $seconds = abs($seconds);

        $units = [
            31536000 => 'year',
            2592000 => 'month',
            WEEK_IN_SECONDS => 'week',
            DAY_IN_SECONDS => 'day',
            HOUR_IN_SECONDS => 'hour',
            MINUTE_IN_SECONDS => 'minute',
            1 => 'second',
        ];

        foreach ($units as $unit => $label) {

            if ($seconds >= $unit) {

                $value = (int) floor(
                    $seconds / $unit
                );

                return sprintf(
                    _n(
                        '%1$d ' . $label,
                        '%1$d ' . $label . 's',
                        $value,
                        'a9-post-adaptation'
                    ),
                    $value
                );
            }
        }

        return __('0 seconds', 'a9-post-adaptation');
    }
}
