<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Blocks;

final class DynamicPrice extends DynamicBlock
{
    /**
     * Block slug.
     */
    protected function slug(): string
    {
        return 'price';
    }

    /**
     * Meta key.
     */
    protected function metaKey(): string
    {
        return 'a9_price';
    }

    /**
     * Render Price block.
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

        $price = (float) get_post_meta(
                $postId,
                $this->metaKey(),
                true
            );


        if ($price <= 0) {
            return '';
        }

        if ($price === '' || $price === null) {
            return '';
        }

        return sprintf(
            '<span class="a9-price">$%s</span>',
            esc_html(number_format((float) $price, 2))
        );
    }
}