<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Tests\Stubs;

use function compact;

final class LocalHandlerStub
{
    public function __invoke($messageContract, $message, $messageString)
    {
        return compact('messageContract', 'message', 'messageString');
    }
}