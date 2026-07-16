<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Meta;

final class AgeGroup
{
    /**
     * Register the Age Group meta field.
     */
    public static function register(): void
    {
        register_post_meta(
            'post',
            'a9_age_group',
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
            'label'       => __('Age Group', 'a9-post-adaptation'),
            'meta_key'    => 'a9_age_group',
            'type'        => 'text',
            'description' => __('Enter the age group.', 'a9-post-adaptation'),
            'default'     => '',
            'required'    => false,
            'options'     => [],
        ];
    }

    /**
     * Sanitize the age group value.
     */
    public static function sanitize(mixed $value): string
    {
        return sanitize_text_field((string) $value);
    }
}