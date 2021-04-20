<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Stubs;

use SevenLinX\PubSub\Contracts\MessageContract;

final class MessageStub implements MessageContract
{
    /**
     * @var string
     */
    private const MESSAGE = 'message';

    public function payload(): string
    {
        return self::MESSAGE;
    }
}