<?php

namespace App\Domain\Bus\Event;

/**
 * Interface EventProviderInterface
 * @package CoreBundle\Domain\Bus\Event
 */
interface EventProviderInterface
{
    /**
     * @access public
     * @param DomainEventInterface $event
     * @return void
     */
    public function record(DomainEventInterface $event);
    /**
     * Release the pending events
     * @access public
     * @return DomainEventInterface[] $events
     */
    public function release();
}