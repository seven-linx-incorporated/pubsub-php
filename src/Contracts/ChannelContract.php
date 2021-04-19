<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Contracts;

interface ChannelContract
{
    public function name(): string;
}