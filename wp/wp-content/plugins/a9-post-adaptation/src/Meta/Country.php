<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Meta;

use A9\PostAdaptation\Data\Countries;

final class Country
{
    /**
     * Register the Country / Region meta field.
     */
    public static function register(): void
    {
        register_post_meta(
            'post',
            'a9_country',
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
     *
     * NOTE:
     * The options array will be populated from
     * Data\Countries::all() in Milestone 9.1.
     */
    public static function field(): array
    {
        return [
            'label'       => __('Country / Region', 'a9-post-adaptation'),
            'meta_key'    => 'a9_country',
            'type'        => 'select',
            'description' => __('Select the country or region.', 'a9-post-adaptation'),
            'default'     => '',
            'required'    => false,
            'options'     => Countries::options(),
        ];
    }

    /**
     * Sanitize the country value.
     */
    public static function sanitize(mixed $value): string
    {
        return strtoupper(sanitize_text_field((string) $value));
    }
}