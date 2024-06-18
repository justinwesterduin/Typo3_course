<?php
declare(strict_types=1);

namespace TTN\Tea\Event;

class ImportCompletedEvent
{
    public function __construct(
        private string $message,
        private int $amount
    )
    {
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getAmount(): int
    {
        return $this -> amount;
    }

    public function setAmount(int $amount): void
    {
        $this -> amount = $amount;
    }
}