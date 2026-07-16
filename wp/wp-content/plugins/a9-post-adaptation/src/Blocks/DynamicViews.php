<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Blocks;

final class DynamicViews extends DynamicBlock
{
    /**
     * Block folder name.
     */
    protected function slug(): string
    {
        return 'views';
    }

    /**
     * Meta key.
     *
     * Not used by this block.
     */
    protected function metaKey(): string
    {
        return '';
    }

    /**
     * Render Views.
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

        $views = (int) get_post_meta(
            $postId,
            'a9_post_views',
            true
        );

        if ($views < 1000) {
            return '';
        }

        return sprintf(
            '<span class="a9-views">%d</span>',
            $views
        );
    }
}