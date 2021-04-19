<?php
declare(strict_types=1);

namespace SevenLinX\PubSub\Contracts;

interface MessageContract
{
    public function payload(): string;
}