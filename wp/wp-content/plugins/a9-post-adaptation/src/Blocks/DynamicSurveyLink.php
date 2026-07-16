<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Blocks;

final class DynamicSurveyLink extends DynamicBlock
{
    /**
     * Block folder name.
     */
    protected function slug(): string
    {
        return 'survey-link';
    }

    /**
     * Meta key.
     */
    protected function metaKey(): string
    {
        return 'a9_survey_link';
    }

    /**
     * Render Survey Link.
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

        $url = (string) get_post_meta(
            $postId,
            $this->metaKey(),
            true
        );

        if ($url === '') {
            return '';
        }

        $label = trim((string) ($attributes['label'] ?? ''));

        if ($label === '') {
            $label = __('Open Survey', 'a9-post-adaptation');
        }

        $wrapperAttributes = get_block_wrapper_attributes(
            [
                'class' => 'a9-survey-link',
            ]
        );

        return sprintf(
            '<a %1$s href="%2$s" target="_blank" rel="noopener noreferrer">%3$s</a>',
            $wrapperAttributes,
            esc_url($url),
            esc_html($label)
        );
    }
}