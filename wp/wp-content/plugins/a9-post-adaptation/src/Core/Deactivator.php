<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Core;

final class Deactivator
{
    public static function deactivate(): void
    {
        flush_rewrite_rules();
    }
}