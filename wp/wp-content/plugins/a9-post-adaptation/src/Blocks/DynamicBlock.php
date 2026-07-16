<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Blocks;

abstract class DynamicBlock
{
    /**
     * Block folder name.
     */
    abstract protected function slug(): string;

    /**
     * Meta key.
     */
    abstract protected function metaKey(): string;

    /**
     * Register the block.
     */
    public function register(): void
    {
        add_action('init', [$this, 'registerBlock']);
    }

    /**
     * Register the dynamic block.
     */
    public function registerBlock(): void
    {
        register_block_type(
            A9_POST_ADAPTATION_PATH . 'src/BlockMetadata/' . $this->slug(),
            [
                'editor_script'   => 'a9-post-adaptation-editor',
                'render_callback' => [$this, 'render'],
            ]
        );
    }

    /**
     * Render the block.
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

        $value = get_post_meta(
            $postId,
            $this->metaKey(),
            true
        );

        if ($value === '' || $value === null) {
            return '';
        }

        $field = \A9\PostAdaptation\Meta\Registry::field(
            $this->metaKey()
        );

        $value = \A9\PostAdaptation\Helpers\Formatter::format(
            $value,
            $field['type']
        );

        return sprintf(
            '<span class="%s">%s</span>',
            esc_attr(str_replace('_', '-', $this->metaKey())),
            esc_html((string) $value)
        );
    }
}