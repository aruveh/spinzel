<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Meta;

final class EndDateTime
{
    /**
     * Register the End Date & Time meta field.
     */
    public static function register(): void
    {
        register_post_meta(
            'post',
            'a9_end_datetime',
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
            'label'       => __('End Date & Time', 'a9-post-adaptation'),
            'meta_key'    => 'a9_end_datetime',
            'type'        => 'datetime-local',
            'description' => __('Select the survey end date and time.', 'a9-post-adaptation'),
            'default'     => '',
            'required'    => false,
        ];
    }

    /**
     * Sanitize the value.
     */
    public static function sanitize(mixed $value): string
    {
        return sanitize_text_field((string) $value);
    }
}