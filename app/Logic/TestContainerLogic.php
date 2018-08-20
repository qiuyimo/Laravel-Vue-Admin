<?php

namespace App\Logic;

use Illuminate\Foundation\Application;
use App\Http\Controllers\Container\TestContainerController;

class TestContainerLogic
{
    /**
     * @var $container \Illuminate\Foundation\Application
     */
    protected $container;

    /**
     * TestContainerController constructor.
     * @param Application $container
     */
    public function __construct(Application $container)
    {
        $this->container = $container;
    }

    public function getData($name)
    {
        return $this->container->make($name);
    }
}