<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Generics;

final class GenericStringPayload extends AbstractPayload
{
    public function __construct(private string $payload, string $channel)
    {
        parent::__construct($channel);
    }

    public function payload(): string
    {
        return $this->payload;
    }
}