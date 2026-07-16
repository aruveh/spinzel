<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Blocks;

use A9\PostAdaptation\Helpers\SurveyStatus;

final class DynamicSurveyStatus extends DynamicBlock
{
    /**
     * Block folder name.
     */
    protected function slug(): string
    {
        return 'survey-status';
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
     * Render Survey Status.
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

        $status = SurveyStatus::get($postId);

        $wrapperAttributes = get_block_wrapper_attributes(
            [
                'class' => 'a9-survey-status',
            ]
        );

        return sprintf(
            '<div %1$s>
                <div class="a9-survey-progress survey-progress-bar">
                    <div
                        class="a9-survey-progress__bar survey-progress-fill"
                        style="width:%6$d%%">
                    </div>
                </div>
                <span class="a9-status-message">
                    %5$s
                </span>
            </div>
            ',
            $wrapperAttributes,
            esc_attr($status['status']['code']),
            esc_html($status['status']['icon']),
            esc_html($status['status']['label']),
            esc_html($status['status']['message']),
            (int) $status['progress']['elapsed']
        );
    }
}