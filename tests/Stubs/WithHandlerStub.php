<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Tests\Stubs;

use SevenLinX\PubSub\Contracts\MessageContract;

final class WithHandlerStub
{
    public function handle(MessageContract $message): void
    {
        $message->payload();
    }
}