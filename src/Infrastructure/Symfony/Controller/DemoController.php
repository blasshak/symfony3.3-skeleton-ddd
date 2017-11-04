<?php

namespace App\Infrastructure\Symfony\Controller;

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
        var_dump("ss");
        exit();
    }
}
