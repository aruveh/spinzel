<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Blocks;

final class DynamicPublished extends DynamicBlock
{
    /**
     * Block folder name.
     */
    protected function slug(): string
    {
        return 'published';
    }

    /**
     * Meta key.
     *
     * Not used by this block, but required by DynamicBlock.
     */
    protected function metaKey(): string
    {
        return '';
    }

    /**
     * Render Published Date.
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

        return sprintf(
            '<span class="a9-published">%s</span>',
            esc_html(get_the_date('j M Y', $postId))
        );
    }
}