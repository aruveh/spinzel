<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Blocks;

final class DynamicReadingTime extends DynamicBlock
{
    /**
     * Block folder name.
     */
    protected function slug(): string
    {
        return 'reading-time';
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
     * Render Reading Time.
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

        $content = wp_strip_all_tags(
            get_post_field('post_content', $postId)
        );

        $words = str_word_count($content);

        $minutes = max(
            1,
            (int) ceil($words / 200)
        );

        return sprintf(
            '<span class="a9-reading-time">⏱ %d min</span>',
            $minutes
        );
    }
}