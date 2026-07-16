<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Meta;

final class Price
{
    /**
     * Register the Price meta field.
     */
    public static function register(): void
    {
        register_post_meta(
            'post',
            'a9_price',
            [
                'type'              => 'number',
                'single'            => true,
                'default'           => 0,
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
            'label'       => __('Price', 'a9-post-adaptation'),
            'meta_key'    => 'a9_price',
            'type'        => 'number',
            'description' => __('Enter the price.', 'a9-post-adaptation'),
            'default'     => 0,
            'required'    => false,
            'options'     => [],
        ];
    }

    /**
     * Sanitize the price value.
     */
    public static function sanitize(mixed $value): float
    {
        return is_numeric($value) ? (float) $value : 0.0;
    }
}