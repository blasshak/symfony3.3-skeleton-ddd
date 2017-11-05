<?php

namespace App\Application\Bus\UseCase\Prueba;

use App\Domain\Bus\Event\EventProviderInterface;
use App\Domain\Bus\Event\Prueba\UserResgisteredEvent;

class ShowUseCase
{
    public function __construct(EventProviderInterface $eventProvider)
    {
        $this->eventProvider = $eventProvider;
    }

    /**
     * @access public
     * @param array $request
     * @return mixed
     */
    public function execute(array $request)
    {
        $this->eventProvider->record(new UserResgisteredEvent());

        return array();
    }
}
