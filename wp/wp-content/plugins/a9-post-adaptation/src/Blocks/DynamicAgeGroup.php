<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Blocks;

final class DynamicAgeGroup extends DynamicBlock
{
    /**
     * Block slug.
     */
    protected function slug(): string
    {
        return 'age-group';
    }

    /**
     * Meta key.
     */
    protected function metaKey(): string
    {
        return 'a9_age_group';
    }

    /**
     * Render Age Group block.
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

        $ageGroup = get_post_meta(
            $postId,
            $this->metaKey(),
            true
        );

        if ($ageGroup === '' || $ageGroup === null) {
            return '';
        }

        return sprintf(
            '<span class="a9-age-group">%s</span>',
            esc_html((string) $ageGroup)
        );
    }
}