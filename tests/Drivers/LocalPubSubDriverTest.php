<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Tests\Drivers;

use Closure;
use Mockery;
use PHPUnit\Framework\TestCase;
use SevenLinX\PubSub\Drivers\LocalPubSubDriver;
use SevenLinX\PubSub\Tests\Stubs\ChannelStub;
use SevenLinX\PubSub\Tests\Stubs\LocalHandlerStub;
use SevenLinX\PubSub\Tests\Stubs\LocalHandlerWithPriorityStub;
use SevenLinX\PubSub\Tests\Stubs\MessageStub;
use stdClass;

final class LocalPubSubDriverTest extends TestCase
{
    public function testPublish(): void
    {
        $channel = new ChannelStub();
        $driver = new LocalPubSubDriver();
        $message = new MessageStub();

        $handler1 = Mockery::mock(stdClass::class);
        $handler1->shouldReceive('handle')
            ->with($message, $message->message(), $message->toString())
            ->once();
        $driver->subscribe($channel, [$handler1, 'handle']);

        $handler3 = Mockery::mock(stdClass::class);
        $handler3->shouldNotReceive('handle');
        $driver->subscribe($channel, [$handler3, 'handle']);

        $driver->publish($channel, $message);
    }

    public function testSubscribe(): void
    {
        $driver = new LocalPubSubDriver();
        $channel = new ChannelStub();

        $driver->subscribe($channel, new LocalHandlerStub());
        $driver->subscribe($channel, new LocalHandlerWithPriorityStub());
        $driver->subscribe($channel, function () {
            return 'hey';
        });

        $subscriber = $driver->getSubscriber($channel);

        self::assertCount(3, $subscriber);
        self::assertInstanceOf(LocalHandlerStub::class, $subscriber[0]);
        self::assertInstanceOf(LocalHandlerWithPriorityStub::class, $subscriber[2]);
        self::assertInstanceOf(Closure::class, $subscriber[1]);
    }
}