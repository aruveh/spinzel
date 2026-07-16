<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Blocks;

final class DynamicMetaRow extends DynamicBlock
{
    /**
     * Block slug.
     */
    protected function slug(): string
    {
        return 'meta-row';
    }

    /**
     * Not used by this block.
     */
    protected function metaKey(): string
    {
        return '';
    }

    /**
     * Render Meta Row.
     */
    public function render(
        array $attributes = [],
        string $content = '',
        ?\WP_Block $block = null
    ): string {
        $country = (new DynamicCountry())->render([], '', $block);
        $price = (new DynamicPrice())->render([], '', $block);
        $ageGroup = (new DynamicAgeGroup())->render([], '', $block);

        if ($country === '' && $price === '' && $ageGroup === '') {
            return '';
        }

        $items = array_filter([
            $country,
            $price,
            $ageGroup,
        ]);

        return sprintf(
            '<div class="a9-meta-row">%s</div>',
            implode(
                '<span class="a9-meta-separator"></span>',
                $items
            )
        );
    }
}