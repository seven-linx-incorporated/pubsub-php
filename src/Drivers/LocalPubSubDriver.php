<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Drivers;

use Illuminate\Support\Collection;
use SevenLinX\PubSub\Contracts\ChannelContract;
use SevenLinX\PubSub\Contracts\HasPriorityHandler;
use SevenLinX\PubSub\Contracts\MessageContract;
use SevenLinX\PubSub\PubSubDriverInterface;

final class LocalPubSubDriver implements PubSubDriverInterface
{
    /**
     * @var array<string, callable[]>
     */
    private array $subscribers = [];

    public function getSubscriber(ChannelContract $channel): array
    {
        return $this->subscribers[$channel->name()];
    }

    private function priorities(Collection $collection): array
    {
        return $collection
            ->sort(fn($handler) => $handler instanceof HasPriorityHandler ? $handler->priority() : 0)
            ->values()
            ->toArray();
    }

    public function publish(ChannelContract $channel, MessageContract $message): void
    {
        $channelName = $channel->name();
        $handlers = isset($this->subscribers[$channelName]) === false ? [] : $this->subscribers[$channelName];

        foreach ($handlers as $handler) {
            if (is_callable($handler) === true) {
                $handler($message, $message->payload());
            }
        }
    }

    public function publishBatch(ChannelContract $channel, MessageContract ...$messages): void
    {
        foreach ($messages as $message) {
            $this->publish($channel, $message);
        }
    }

    public function subscribe(ChannelContract $channel, callable $handler): void
    {
        $channelName = $channel->name();

        if (isset($this->subscribers[$channelName]) === false) {
            $this->subscribers[$channelName] = [];
        }
        $subscribers = Collection::make($this->subscribers[$channelName]);
        $subscribers->add($handler);

        $this->subscribers[$channelName] = $this->priorities($subscribers);
    }
}