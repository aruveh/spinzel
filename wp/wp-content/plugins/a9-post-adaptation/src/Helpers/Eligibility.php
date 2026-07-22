<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Helpers;

use DateTimeImmutable;
use DateTimeZone;

final class Eligibility
{
    /**
     * Determine survey eligibility.
     */
    public static function get(int $postId): array
    {
        $requiredCountry = strtoupper(
            trim(
                (string) get_post_meta(
                    $postId,
                    'a9_country',
                    true
                )
            )
        );

        $visitorCountry = Country::visitor();

        $start = trim(
            (string) get_post_meta(
                $postId,
                'a9_start_datetime',
                true
            )
        );

        $end = trim(
            (string) get_post_meta(
                $postId,
                'a9_end_datetime',
                true
            )
        );
        
        // No country restriction.

        $countryMatched = (
            $requiredCountry === ''
            || Country::matches($requiredCountry)
        );

        $dateResult = self::dateEligibility(
            $start,
            $end
        );

        $allowed = $countryMatched
            && $dateResult['allowed'];

        $reason = null;

        if (! $countryMatched) {
            $reason = 'country_restricted';
        } elseif (! $dateResult['allowed']) {
            $reason = $dateResult['reason'];
        }

        return [
            'allowed' => $allowed,
            'reason' => $reason,

            'country' => [
                'visitor' => $visitorCountry,
                'required' => $requiredCountry ?: null,
                'matched' => $countryMatched,
            ],

            'schedule' => [
                'start' => $start ?: null,
                'end' => $end ?: null,
                'started' => $dateResult['started'],
                'expired' => $dateResult['expired'],
                'matched' => $dateResult['allowed'],
            ],
        ];
    }

    /**
     * Check survey start/end dates.
     */
    private static function dateEligibility(
        string $start,
        string $end
    ): array {
        $timezone = wp_timezone();

        $now = new DateTimeImmutable(
            'now',
            $timezone
        );

        $started = true;
        $expired = false;
        $reason = null;

        if ($start !== '') {
            $startDate = DateTimeImmutable::createFromFormat(
                'Y-m-d\TH:i',
                $start,
                $timezone
            );

            if ($startDate instanceof DateTimeImmutable) {
                if ($now < $startDate) {
                    $started = false;
                    $reason = 'survey_not_started';
                }
            }
        }

        if ($end !== '') {
            $endDate = DateTimeImmutable::createFromFormat(
                'Y-m-d\TH:i',
                $end,
                $timezone
            );

            if ($endDate instanceof DateTimeImmutable) {
                if ($now > $endDate) {
                    $expired = true;
                    $reason = 'survey_expired';
                }
            }
        }

        return [
            'allowed' => $started && ! $expired,
            'reason' => $reason,
            'started' => $started,
            'expired' => $expired,
        ];
    }
}