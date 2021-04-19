<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Tests\Stubs;

use SevenLinX\PubSub\Contracts\MessageContract;

final class MessageStub implements MessageContract
{
    /**
     * @var string
     */
    private const MESSAGE = 'message';

    public function message(): mixed
    {
        return self::MESSAGE;
    }

    public function toString(): string
    {
        return self::MESSAGE;
    }
}