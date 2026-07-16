<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Shortcodes;

final class Price
{
    public function register(): void
    {
        add_shortcode('a9_price', [$this, 'render']);
    }

    public function render(): string
    {
        return (new Meta())->render([
            'key' => 'price',
        ]);
    }
}