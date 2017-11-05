<?php

namespace App\Infrastructure\Symfony\Controller;

use App\Application\Service\Prueba\ShowService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DemoController
 * @package App\Infrastructure\Symfony\Controller
 */
class DemoController extends Controller
{
    /**
     * @access public
     * @return void
     */
    public function showAction()
    {
        /** @var ShowService $showPruebaService */
        $showService = $this->get('application.show_service');
        $showService->execute(array('text' => 'pruebaaaaaaaaaaaaaaaaa'));
        var_dump("exit");
        exit();
    }
}
