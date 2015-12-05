<?php

namespace Library;
use \Pimple\Container;
use \Library;

/**
 * Class Di
 * @package Library
 */
class Di
{
    /**
     * This will get the DI Containers:
     * @return Container
     */
    public function getDi()
    {
        //init pimple container
        $container = new Container();

        //this is a test example class
        $container['test'] = function () {
            return new Library\Test();
        };

        //return DI Container
        return $container;
    }
}