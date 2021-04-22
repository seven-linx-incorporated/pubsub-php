<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Tests\Drivers;

use Closure;
use Mockery;
use PHPUnit\Framework\TestCase;
use SevenLinX\PubSub\Drivers\LocalPubSubDriver;
use SevenLinX\PubSub\Generics\GenericChannel;
use SevenLinX\PubSub\Generics\GenericMessage;
use SevenLinX\PubSub\Generics\GenericPayload;
use SevenLinX\PubSub\Tests\Stubs\LocalHandlerStub;
use stdClass;

/**
 * @covers \SevenLinX\PubSub\Drivers\LocalPubSubDriver
 */
final class LocalPubSubDriverTest extends TestCase
{
    public function testPublish(): void
    {
        $channel = new GenericChannel();
        $driver = new LocalPubSubDriver();
        $message = new GenericMessage();

        $handler1 = Mockery::mock(stdClass::class);
        $handler1->shouldReceive('handle')
            ->with(GenericPayload::class)
            ->once();
        $driver->subscribe($channel, [$handler1::class, 'handle']);

        $handler2 = Mockery::mock(stdClass::class);
        $handler2->shouldNotReceive('handle');
        $driver->subscribe($channel, [$handler2, 'handle']);

        $driver->publish($channel, $message);

        self::assertCount(2, $driver->getSubscriber($channel));
    }

    public function testSubscribe(): void
    {
        $driver = new LocalPubSubDriver();
        $channel = new GenericChannel();

        $driver->subscribe($channel, new LocalHandlerStub());
        $driver->subscribe($channel, function () {
            return 'hey';
        });

        $subscriber = $driver->getSubscriber($channel);

        self::assertCount(2, $subscriber);
        self::assertInstanceOf(LocalHandlerStub::class, $subscriber[0]);
        self::assertInstanceOf(Closure::class, $subscriber[1]);
    }
}
