<?php

namespace App\Application\Bus\UseCase\Prueba;

use App\Application\Bus\UseCase\RequestInterface;
use App\Domain\Bus\Event\EventProviderInterface;
use App\Domain\Bus\Event\Prueba\UserRegisteredEvent;

/**
 * Class ShowUseCase
 * @package App\Application\Bus\UseCase\Prueba
 */
final class ShowUseCase
{
    /**
     * @access public
     * @param EventProviderInterface $eventProvider
     */
    public function __construct(EventProviderInterface $eventProvider)
    {
        $this->eventProvider = $eventProvider;
    }

    /**
     * @access public
     * @param RequestInterface $request
     * @return mixed
     */
    public function execute(RequestInterface $request)
    {
        $text = $request->text();
        $this->eventProvider->record(new UserRegisteredEvent());

        return array();
    }
}
