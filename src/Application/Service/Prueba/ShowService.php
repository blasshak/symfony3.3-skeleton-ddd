<?php

namespace App\Application\Service\Prueba;

use App\Application\Bus\UseCase\Prueba\ShowRequest;
use App\Application\Service\AbstractApplicationService;

/**
 * Class ShowService
 * @package App\Application\Service\Prueba
 */
class ShowService extends AbstractApplicationService
{
    /**
     * @access public
     */
    public function __construct()
    {
        $middlewares = array();
        parent::__construct($middlewares);
    }

    /**
     * @access public
     * @param array $request
     * @return mixed
     */
    public function execute(array $request)
    {
        $command = ShowRequest::create($request);
        $value = $this->userCaseBus->handle($command);

        return $value;
    }
}
