<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Helpers;

final class Sanitizer
{
    /**
     * Sanitize a value based on field type.
     */
    public static function sanitize(
        mixed $value,
        string $type
    ): mixed {
        return match ($type) {
            'number' => self::number($value),
            'text'   => self::text($value),
            'select' => self::select($value),
            default  => sanitize_text_field((string) $value),
        };
    }

    /**
     * Sanitize a number.
     */
    public static function number(mixed $value): float
    {
        return is_numeric($value)
            ? (float) $value
            : 0.0;
    }

    /**
     * Sanitize text.
     */
    public static function text(mixed $value): string
    {
        return sanitize_text_field((string) $value);
    }

    /**
     * Sanitize select values.
     */
    public static function select(mixed $value): string
    {
        return sanitize_text_field((string) $value);
    }
}