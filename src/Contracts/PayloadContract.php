<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Contracts;

interface PayloadContract
{
    public function getChannel(): string;

    public function payload(): mixed;
}