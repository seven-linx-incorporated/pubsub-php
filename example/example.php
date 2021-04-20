<?php
declare(strict_types=1);

include dirname(__DIR__).'/vendor/autoload.php';

use SevenLinX\PubSub\Contracts\MessageContract;
use SevenLinX\PubSub\Drivers\LocalPubSubDriver;
use SevenLinX\PubSub\Generics\GenericChannel;
use SevenLinX\PubSub\Generics\GenericMessage;
use SevenLinX\PubSub\Generics\GenericPayload;

$driver = new LocalPubSubDriver();
$channel = new GenericChannel();
$handler = new class {
    public function __invoke(GenericPayload $payload)
    {
        var_dump($payload->payload());
    }
};

$driver->subscribe($channel, $handler);

$driver->publish(new GenericChannel(), new GenericMessage());

$message = new class implements MessageContract {
    public function payload(): string
    {
        return json_encode(['foo' => 'bar'], JSON_THROW_ON_ERROR);
    }
};

$driver->publish(new GenericChannel(), $message);
