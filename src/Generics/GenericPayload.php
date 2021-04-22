<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Generics;

use JsonException;

use function json_decode;

use const JSON_THROW_ON_ERROR;

final class GenericPayload extends AbstractPayload
{
    public function __construct(private mixed $payload, string $channel)
    {
        parent::__construct($channel);
    }

    public function payload(): mixed
    {
        try {
            return json_decode($this->payload, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            $jsonEncode = json_encode($this->payload, JSON_THROW_ON_ERROR);

            return json_decode($jsonEncode, true, 512, JSON_THROW_ON_ERROR);
        }
    }
}