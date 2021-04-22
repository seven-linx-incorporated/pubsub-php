<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Generics;

use function serialize;

final class GenericSerializePayload extends AbstractPayload
{
    public function __construct(private mixed $payload, string $channel)
    {
        parent::__construct($channel);
    }

    public function payload(): string
    {
        return serialize($this->payload);
    }
}