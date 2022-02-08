<?php

declare(strict_types=1);

namespace Application\Event;

class SampleEvent
{
    public function __construct(private string $message)
    {
    }

    public function getMessage(): string
    {
        return $this->message;
    }


}
