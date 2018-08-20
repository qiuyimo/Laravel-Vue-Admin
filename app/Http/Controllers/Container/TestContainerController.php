<?php

namespace App\Http\Controllers\Container;

use App\Logic\TestContainerLogic;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 使用容器, 示例.
 * Class TestContainerController
 * @package App\Http\Controllers
 */
class TestContainerController extends Controller
{
    /**
     * @var $container \Illuminate\Foundation\Application
     */
    protected $container;

    /**
     * @var $testContainerLogic \App\Logic\TestContainerLogic;
     */
    protected $testContainerLogic;

    /**
     * TestContainerController constructor.
     * @param Application $container
     * @param TestContainerLogic $testContainer
     */
    public function __construct(Application $container, TestContainerLogic $testContainerLogic)
    {
        $this->container = $container;
        $this->testContainerLogic = $testContainerLogic;
    }

    /**
     * 添加数据到容器.
     * @param string $name
     * @param mixed $data
     */
    protected function setData(string $name, $data)
    {
        $this->container->instance($name, $data);
    }

    /**
     * 从容器中获取数据.
     * @param string $name
     * @return mixed
     */
    protected function getData(string $name)
    {
        return $this->container->make($name);
    }

    /**
     * 测试方法
     */
    public function test()
    {
        /**
         * 这里分别存储了 string , array, object. 都是可以的.
         */
        $name = 'test';
        // $data = ['aaa', 'bbb'];
        // $data = 'demo';
        $data = $this;

        $this->setData($name, $data);
        $res = $this->getData('test');
        dump($res);

        /**
         * 在 controller 中 set 数据, 在 logic 中获取数据.
         * 在不同的类中分别设置和获取数据, 用来测试容器中设置获取数据是否是全局的.
         */
        $name = 'getDataFromLogicName';
        $data = 'getDataFromLogicData';

        $this->container->instance($name, $data);
        $res = $this->testContainerLogic->getData($name);
        dump($res);
    }
}
