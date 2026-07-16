<?php

declare(strict_types=1);

namespace A9\PostAdaptation\Blocks;

final class DynamicStartDate extends DynamicBlock
{
    /**
     * Block folder name.
     */
    protected function slug(): string
    {
        return 'start-date';
    }

    /**
     * Meta key.
     */
    protected function metaKey(): string
    {
        return 'a9_start_datetime';
    }
}