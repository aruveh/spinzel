<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Shortcodes;

final class AgeGroup
{
    public function register(): void
    {
        add_shortcode('a9_age_group', [$this, 'render']);
    }

    public function render(): string
    {
        return (new Meta())->render([
            'key' => 'age_group',
        ]);
    }
}