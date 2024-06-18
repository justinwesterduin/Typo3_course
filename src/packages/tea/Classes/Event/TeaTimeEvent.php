<?php
declare(strict_types=1);

namespace TTN\Tea\Event;

use TTN\Tea\Domain\Model\Tea;

class TeaTimeEvent
{
    public function __construct(
        private Tea $tea,
        private readonly \DateTime $dateTime,
        private string $comment
    ) {
    }

    public function getTea(): Tea
    {
        return $this->tea;
    }

    public function setTea(Tea $tea): void
    {
        $this->tea = $tea;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }
}