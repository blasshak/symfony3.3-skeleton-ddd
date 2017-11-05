<?php

namespace App\Infrastructure\Bus\Event;

use App\Domain\Bus\Event\DomainEventInterface;
use App\Domain\Bus\Event\EventBusInterface;
use App\Domain\Bus\Event\ListenerInterface;

/**
 * Class EventBus
 * @package App\Infrastructure\Bus\Event
 */
class EventBus implements EventBusInterface
{
    /**
     * @access private
     * @var  ListenerInterface[] $listeners
     */
    private $listeners;

    /**
     * @access public
     * @param string $eventName
     * @param ListenerInterface $listener
     * @return void
     */
    public function addListener(string $eventName, ListenerInterface $listener) : void
    {
        $this->listeners[$eventName][] = $listener;
    }

    /**
     * @access public
     * @param $event
     * @return void
     */
    public function dispatch(DomainEventInterface $event) : void
    {
        if (isset($this->listeners[$event->name()])) {
            /** @var ListenerInterface[] $listeners */
            $listeners = $this->listeners[$event->name()];

            foreach ($listeners as $listener) {
                $listener->handle($event);
            }
        }
    }
}
