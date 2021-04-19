<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Contracts;

interface MessageContract
{
    public function message(): mixed;

    public function toString(): string;
}