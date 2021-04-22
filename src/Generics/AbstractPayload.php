<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Generics;

use SevenLinX\PubSub\Contracts\PayloadContract;

abstract class AbstractPayload implements PayloadContract
{
    public function __construct(protected string $channel)
    {
    }

    public function getChannel(): string
    {
        return $this->channel;
    }
}