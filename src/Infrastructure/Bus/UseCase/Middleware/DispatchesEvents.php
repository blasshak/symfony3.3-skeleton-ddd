<?php

namespace App\Infrastructure\Bus\UseCase\Middleware;

use App\Application\Bus\UseCase\Middleware\MiddlewareInterface;
use App\Domain\Bus\Event\EventBusInterface;
use App\Domain\Bus\Event\EventProviderInterface;

/**
 * Class DispatchesEvents
 * @package App\Infrastructure\Bus\UseCase\Middleware
 */
class DispatchesEvents implements MiddlewareInterface
{
    /**
     * @access private
     * @var EventBusInterface
     */
    private $eventBus;
    /**
     * @access private
     * @var EventProviderInterface
     */
    private $eventProvider;
    /**
     * @acces public
     * @param EventBusInterface $eventBus
     * @param EventProviderInterface $eventProvider
     */
    public function __construct(EventBusInterface $eventBus, EventProviderInterface $eventProvider)
    {
        $this->eventBus = $eventBus;
        $this->eventProvider = $eventProvider;
    }

    /**
     * @access public
     * @param array $request
     * @param callable $next
     * @return mixed
     * @throws \Exception
     */
    public function execute(array $request, callable $next)
    {
        try {
            $returnValue = $next($request);
            $events = $this->eventProvider->release();
            foreach ($events as $event) {
                $this->eventBus->handle($event);
            }
        } catch (\Exception $e) {
            throw $e;
        }
        return $returnValue;
    }
}
