<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Drivers;

use SevenLinX\PubSub\Contracts\ChannelContract;
use SevenLinX\PubSub\Contracts\MessageContract;
use SevenLinX\PubSub\PubSubDriverInterface;

final class VoidPubSubDriver implements PubSubDriverInterface
{
    public function publish(ChannelContract $channel, MessageContract $message): void
    {
    }

    public function publishBatch(ChannelContract $channel, MessageContract ...$messages): void
    {
    }

    public function subscribe(ChannelContract $channel, callable $handler): void
    {
    }
}