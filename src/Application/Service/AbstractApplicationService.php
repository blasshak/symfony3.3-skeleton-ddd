<?php

namespace App\Application\Service;

use App\Application\Bus\UseCase\UserCaseBusInterface;

/**
 * Class AbstractApplicationService
 * @package App\Application\Service
 */
abstract class AbstractApplicationService
{
    /**
     * @access private
     * @var array
     */
    private $middlewares;

    /**
     * @access protected
     * @var UserCaseBusInterface
     */
    protected $userCaseBus;

    /**
     * @access public
     * @param array $middlewares
     */
    public function __construct($middlewares)
    {
        $this->middlewares = $middlewares;
    }

    /**
     * @access public
     * @param UserCaseBusInterface $userCaseBus
     */
    public function setUseCaseBus(UserCaseBusInterface $userCaseBus) : void
    {
        $this->userCaseBus = $userCaseBus;
        $this->userCaseBus->preHandle($this->middlewares);
    }

    /**
     * @access public
     * @param array $request
     * @return mixed
     */
    abstract public function execute(array $request);
}
