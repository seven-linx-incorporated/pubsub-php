<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Contracts;

interface HasPriorityHandler
{
    /**
     * @var int
     */
    public const DEFAULT_PRIORITY = 0;

    public function priority(): int;
}