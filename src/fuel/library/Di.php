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
        //Init pimple container
        $container = new Container();

        //This class can be used to execute curl requests (get, post, put, delete)
        $container['\Library\Common\Curl'] = function () {
            return new Library\Common\Curl();
        };

        //This class can be used to extract a product list from the sainsbury's website
        $container['\Library\Consume\ProductList'] = function ($c) {
            return new Library\Consume\ProductList($c['\Library\Common\Curl']);
        };

        //This class can be used to extract an individual product detail from the sainsbury's website
        $container['\Library\Consume\Product'] = function ($c) {
            return new Library\Consume\Product($c['\Library\Common\Curl']);
        };

        //Return DI Container
        return $container;
    }
}
