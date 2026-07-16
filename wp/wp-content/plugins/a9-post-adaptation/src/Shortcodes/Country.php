<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Shortcodes;

final class Country
{
    public function register(): void
    {
        add_shortcode('a9_country', [$this, 'render']);
    }

    public function render(): string
    {
        echo \A9\PostAdaptation\Helpers\Country::visitor();
        return (new Meta())->render([
            'key' => 'country',
        ]);
    }
}