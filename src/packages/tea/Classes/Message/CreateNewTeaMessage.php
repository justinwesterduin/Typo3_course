<?php

namespace TTN\Tea\Message;

use TTN\Tea\Event\TeaMessageEvent;
use TYPO3\CMS\Core\Attribute\WebhookMessage;
use TYPO3\CMS\Core\Messaging\WebhookMessageInterface;

final class CreateNewTeaMessage implements WebhookMessageInterface
{
    public function __construct(
        private readonly string $message,
        private readonly array $data,
    ) {
    }

    public static function createFromEvent(TeaMessageEvent $event): self
    {
        return new self($event->getMessage(), $event->getData());
    }

    public function jsonSerialize(): array
    {
        // Returns an array with data that gets send to the webhook and so to the reaction, use the path to the array value to define the placeholder for said value;
        return [
            'message' => $this->message,
            'data' => $this->data,
        ];
    }
}
