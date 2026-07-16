<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Blocks;

final class DynamicEndDate extends DynamicBlock
{
    /**
     * Block folder name.
     */
    protected function slug(): string
    {
        return 'end-date';
    }

    /**
     * Meta key.
     */
    protected function metaKey(): string
    {
        return 'a9_end_datetime';
    }
}