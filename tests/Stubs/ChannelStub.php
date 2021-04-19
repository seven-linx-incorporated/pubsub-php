<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Tests\Stubs;

use SevenLinX\PubSub\Contracts\ChannelContract;

final class ChannelStub implements ChannelContract
{
    public function name(): string
    {
        return 'test';
    }
}