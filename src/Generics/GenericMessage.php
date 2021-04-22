<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Generics;

use SevenLinX\PubSub\Contracts\MessageContract;

final class GenericMessage implements MessageContract
{
    /**
     * @var string
     */
    public const DEFAULT_MESSAGE = 'message';

    public function __construct(private ?string $message = null)
    {
    }

    public function payload(): string
    {
        return $this->message ?? self::DEFAULT_MESSAGE;
    }
}