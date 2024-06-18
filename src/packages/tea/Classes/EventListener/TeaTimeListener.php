<?php

namespace TTN\Tea\EventListener;

use TTN\Tea\Event\TeaTimeEvent;

class TeaTimeListener
{
    public function __invoke(TeaTimeEvent $event): void
    {
        $tea = $event->getTea();
        $tea->setTitle('Boo' . $tea->getTitle());
        $event->setComment('From listener');
    }
}