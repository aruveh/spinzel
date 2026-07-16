<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Blocks;

use A9\PostAdaptation\Data\Countries;

final class DynamicCountry extends DynamicBlock
{
    /**
     * Block slug.
     */
    protected function slug(): string
    {
        return 'country';
    }

    /**
     * Meta key.
     */
    protected function metaKey(): string
    {
        return 'a9_country';
    }

    /**
     * Render Country block.
     */
    public function render(
        array $attributes = [],
        string $content = '',
        ?\WP_Block $block = null
    ): string {
        $postId = get_the_ID();

        if (! $postId && isset($block->context['postId'])) {
            $postId = (int) $block->context['postId'];
        }

        if (! $postId) {
            return '';
        }

        $code = (string) get_post_meta(
            $postId,
            $this->metaKey(),
            true
        );

        if ($code === '') {
            return '';
        }

        $svg = Countries::flagSvg($code);
        $short = Countries::short($code);
        $name = Countries::name($code);

        $html = '<span class="a9-country">';

        if ($svg !== '') {
            $html .= sprintf(
                '<img class="a9-country-flag" src="%s" alt="%s" loading="lazy" width="20" height="15">',
                esc_url($svg),
                esc_attr($name)
            );
        }

        $html .= sprintf(
            '<span class="a9-country-name">%s</span>',
            esc_html($short)
        );

        $html .= '</span>';

        return $html;
    }
}