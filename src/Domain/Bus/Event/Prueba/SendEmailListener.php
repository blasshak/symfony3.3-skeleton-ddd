<?php

namespace App\Domain\Bus\Event\Prueba;

use App\Domain\Bus\Event\DomainEventInterface;
use App\Domain\Bus\Event\ListenerInterface;

/**
 * Class SendEmailListener
 * @package App\Domain\Bus\Event\Prueba
 */
class SendEmailListener implements ListenerInterface
{
    /**
     * @access public
     * @param DomainEventInterface $event
     * @return void
     */
    public function handle(DomainEventInterface $event) : void
    {
        var_dump('Listener SendEmailListener');
    }
}
