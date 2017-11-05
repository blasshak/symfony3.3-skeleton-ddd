<?php

namespace App\Domain\Bus\Event\Prueba;

use App\Domain\Bus\Event\DomainEventInterface;
use App\Domain\Bus\Event\ListenerInterface;

class SendEmailListener implements ListenerInterface
{
    public function handle(DomainEventInterface $event)
    {
        var_dump('prueba');
    }
}
