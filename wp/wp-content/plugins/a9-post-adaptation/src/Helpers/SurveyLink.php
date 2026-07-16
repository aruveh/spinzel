<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Helpers;

final class SurveyLink
{
    /**
     * Get the survey link for a post.
     */
    public static function value(int $postId): ?string
    {
        $link = trim(
            (string) get_post_meta(
                $postId,
                'a9_survey_link',
                true
            )
        );

        if ($link === '') {
            return null;
        }

        if (! self::canOpen($postId)) {
            return null;
        }

        return $link;
    }

    /**
     * Determine whether the visitor can open the survey.
     */
    public static function canOpen(int $postId): bool
    {
        return self::eligibility($postId)['allowed'];
    }

    /**
     * Get eligibility information.
     */
    public static function eligibility(int $postId): array
    {
        return Eligibility::get($postId);
    }

    /**
     * Get the required country for the survey.
     */
    public static function requiredCountry(int $postId): ?string
    {
        $country = trim(
            (string) get_post_meta(
                $postId,
                'a9_country',
                true
            )
        );

        return $country === ''
            ? null
            : strtoupper($country);
    }

    /**
     * Get the visitor country.
     */
    public static function visitorCountry(): ?string
    {
        return Country::visitor();
    }

    /**
     * Get the reason why the survey cannot be opened.
     */
    public static function reason(int $postId): ?string
    {
        return self::eligibility($postId)['reason'];
    }
}