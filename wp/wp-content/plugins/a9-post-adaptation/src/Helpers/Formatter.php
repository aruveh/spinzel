<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Helpers;

final class Formatter
{
    /**
     * Format a value based on field type.
     */
    public static function format(mixed $value, string $type): string
    {
        return match ($type) {
            'number' => self::number($value),
            default  => self::text($value),
        };
    }

    /**
     * Format a price/number.
     */
    public static function number(mixed $value): string
    {
        if ($value === '' || $value === null) {
            return '';
        }

        return number_format((float) $value, 2, '.', ',');
    }

    /**
     * Format plain text.
     */
    public static function text(mixed $value): string
    {
        return trim((string) $value);
    }
}