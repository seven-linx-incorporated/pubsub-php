<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Drivers;

use Closure;
use SevenLinX\PubSub\Contracts\ChannelContract;
use SevenLinX\PubSub\Contracts\MessageContract;
use SevenLinX\PubSub\Generics\GenericPayload;
use SevenLinX\PubSub\PubSubDriverInterface;

final class LocalPubSubDriver implements PubSubDriverInterface
{
    /**
     * @var array<string, callable[]>
     */
    private array $subscribers = [];

    /**
     * @return callable[]
     */
    public function getSubscriber(ChannelContract $channel): array
    {
        return $this->subscribers[$channel->name()];
    }

    public function publish(ChannelContract $channel, MessageContract $message): void
    {
        $channelName = $channel->name();
        $handlers = isset($this->subscribers[$channelName]) === false ? [] : $this->subscribers[$channelName];

        foreach ($handlers as $handler) {
            if (is_callable($handler) === true) {
                $handler(new GenericPayload($message->payload(), $channelName));
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

        $this->subscribers[$channelName][] = $handler;
    }
}