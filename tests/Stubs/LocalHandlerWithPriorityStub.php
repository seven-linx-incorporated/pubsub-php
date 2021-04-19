<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Tests\Stubs;

use SevenLinX\PubSub\Contracts\HasPriorityHandler;

final class LocalHandlerWithPriorityStub implements HasPriorityHandler
{
    public function priority(): int
    {
        return 999;
    }

    public function __invoke()
    {

    }
}