<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Generics;

use SevenLinX\PubSub\Contracts\ChannelContract;

final class GenericChannel implements ChannelContract
{
    /**
     * @var string
     */
    private const DEFAULT_NAME = 'test';

    public function __construct(private ?string $channel = null)
    {
    }

    public function name(): string
    {
        return $this->channel ?? self::DEFAULT_NAME;
    }
}