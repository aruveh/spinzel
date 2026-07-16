<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Shortcodes;

use A9\PostAdaptation\Meta\Registry;

final class Meta
{
    public function register(): void
    {
        add_shortcode('a9_meta', [$this, 'render']);
    }

    /**
     * Render the generic meta shortcode.
     *
     * Example:
     * [a9_meta key="price"]
     */
    public function render(array $atts = []): string
    {
        $atts = shortcode_atts([
            'key' => '',
        ], $atts);

        if ($atts['key'] === '') {
            return '';
        }

        $metaKey = 'a9_' . sanitize_key($atts['key']);

        if (! Registry::has($metaKey)) {
            return '';
        }

        $field = Registry::field($metaKey);

        if ($field === null) {
            return '';
        }

        $postId = get_the_ID();

        if (! $postId) {
            return '';
        }

        $value = get_post_meta($postId, $metaKey, true);

        if ($value === '') {
            return '';
        }

        return esc_html(
            \A9\PostAdaptation\Helpers\Formatter::format(
                $value,
                $field['type']
            )
        );
    }
}