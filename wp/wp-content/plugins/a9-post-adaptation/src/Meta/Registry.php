<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Meta;

final class Registry
{
    /**
     * Register all post meta fields.
     */
    public static function register(): void
    {
        Price::register();
        Country::register();
        AgeGroup::register();
        StartDateTime::register();
        EndDateTime::register();
        SurveyLink::register();
        do_action('a9_post_adaptation_register_meta');
    }

    /**
     * Return all registered field definitions.
     */
    public static function fields(): array
    {
        $fields = [
            Price::field(),
            Country::field(),
            AgeGroup::field(),
            StartDateTime::field(),
            EndDateTime::field(),
            SurveyLink::field(),
        ];

        return apply_filters('a9_post_adaptation_fields', $fields);
    }

    /**
     * Return a single field definition by meta key.
     */
    public static function field(string $metaKey): ?array
    {
        foreach (self::fields() as $field) {
            if ($field['meta_key'] === $metaKey) {
                return $field;
            }
        }

        return null;
    }

    /**
     * Check whether a meta key is registered.
     */
    public static function has(string $metaKey): bool
    {
        return self::field($metaKey) !== null;
    }
}