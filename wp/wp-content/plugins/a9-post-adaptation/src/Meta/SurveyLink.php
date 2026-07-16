<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Meta;

final class SurveyLink
{
    /**
     * Register the Survey Link meta field.
     */
    public static function register(): void
    {
        register_post_meta(
            'post',
            'a9_survey_link',
            [
                'type'              => 'string',
                'single'            => true,
                'default'           => '',
                'show_in_rest'      => true,
                'sanitize_callback' => [self::class, 'sanitize'],
                'auth_callback'     => static fn (): bool => current_user_can('edit_posts'),
            ]
        );
    }

    /**
     * Return the field definition.
     */
    public static function field(): array
    {
        return [
            'label'       => __('Survey Link', 'a9-post-adaptation'),
            'meta_key'    => 'a9_survey_link',
            'type'        => 'url',
            'description' => __('Enter the survey URL.', 'a9-post-adaptation'),
            'default'     => '',
            'required'    => false,
        ];
    }

    /**
     * Sanitize the value.
     */
    public static function sanitize(mixed $value): string
    {
        return esc_url_raw((string) $value);
    }
}