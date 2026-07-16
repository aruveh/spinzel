<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Helpers;

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

        // No country restriction.
        if ($requiredCountry === '') {
            return [
                'allowed' => true,
                'reason' => null,

                'country' => [
                    'visitor' => $visitorCountry,
                    'required' => null,
                    'matched' => true,
                ],
            ];
        }

        $matched = Country::matches($requiredCountry);

        return [
            'allowed' => $matched,

            'reason' => $matched
                ? null
                : 'country_restricted',

            'country' => [
                'visitor' => $visitorCountry,
                'required' => $requiredCountry,
                'matched' => $matched,
            ],
        ];
    }
}