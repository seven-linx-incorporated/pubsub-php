# PubSub (PHP)

* * *

## Requirements

- PHP `^8.0`

* * *

## Installation

```sh
composer require sevenlinx/pubsub-php
```

* * *

## Driver

Implement your own driver with `\SevenLinX\PubSub\PubSubDriverInterface`

Example:

```php
use SevenLinX\PubSub\Contracts\ChannelContract;
use SevenLinX\PubSub\Contracts\HasPriorityHandler;
use SevenLinX\PubSub\Contracts\MessageContract;
use SevenLinX\PubSub\PubSubDriverInterface;

final class MyOwnPubSubDriver implements PubSubDriverInterface
{
    public function publish(ChannelContract $channel, MessageContract $message): void
    {
        // How to publish message
    }

    public function publishBatch(ChannelContract $channel, MessageContract ...$messages): void
    {
        // The usual loop
        foreach ($messages as $message) {
            $this->publish($channel, $message);
        }
    }

    public function subscribe(ChannelContract $channel, callable $handler): void
    {
        // What to do when someone publish a message.
    }
}
```

## Subscribe

Subscribe to a message.

Example:

```php
$driver = new MyOwnPubSubDriver();
$channel = new MyOwnChannel();

// Using anonymous function
$driver->subscribe($channel, function ($message) {
    // Do whatever you want.
});
// Using class with __invoke method
$driver->subscribe($channel, new MyOwnHandler());
// Or by custom method name
$driver->subscribe($channel, [MyOwnHandler::class, 'handler']);
```

## Publish

Publish a message

Example:

```php
...

$driver->publish($channel, new MyOwnMessage());
```

## Payload

You can create your own payload by implementing `\SevenLinX\PubSub\Contracts\PayloadContract`

Example:

```php
use SevenLinX\PubSub\Contracts\PayloadContract;

final class Payload implements PayloadContract
{
    public function __construct(private string $message)
    {
    }
    
    public function getChannel() : string
    {
        return 'channel';    
    }
    
    public function payload() : mixed
    {
        return serialize($this->message); 
    }
}
```

You can pass this on your `callable` handler

```php
use SevenLinX\PubSub\Contracts\ChannelContract;

...
public function subscribe(ChannelContract $channel, callable $handler): void
{
    $handler(new Payload('message'));
}
```

## Generics

You can use generics for Channel, Message and Payload

```php
use SevenLinX\PubSub\Generics\GenericChannel;use SevenLinX\PubSub\Generics\GenericMessage;

...
$driver->publish(new GenericChannel('my-own-channel'), new GenericMessage('my-own-message'));
// 
```

* * *

## Example

You can the example in `example/` directory or run:

```sh
php example/example.php
```

## Testing

Just run: 

```sh
composer run testing
```
* * *

###### Created under [Seven LinX Incorporated](https://sevenlinx.tech/)