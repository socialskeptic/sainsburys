<?php

namespace Test\Functional\Library\Consume;
use \Test;
use \Library;

/**
 * Class Product
 * @package Test\Functional\Library\Consume
 */
class Product extends Test\Base
{
    /**
     * This will check if the curl instance is being set correctly.
     */
    public function testCurl()
    {
        //get product instance
        /** @var \Library\Consume\ProductList $product */
        $product = $this->getDi()['\Library\Consume\Product'];

        //get curl instance
        $result = $product->getCurl();

        //check curl instance
        $this->assertTrue($result instanceof Library\Common\Curl);
    }

    /**
     * This will check if the url property works ok.
     */
    public function testUrl()
    {
        //get product instance
        /** @var \Library\Consume\ProductList $product */
        $product = $this->getDi()['\Library\Consume\Product'];

        //set url
        $product->setUrl('http://www.test.com');

        //get url
        $result = $product->getUrl();

        //check url was set correctly
        $this->assertTrue($result === 'http://www.test.com');
    }

    /**
     * testGetResponse:
     */
    public function testGetResponse()
    {
        //get product instance
        /** @var \Library\Consume\ProductList $product */
        $product = $this->getDi()['\Library\Consume\Product'];

        //set url
        $product->setUrl('http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-ripe---ready-red-pear-x4');

        //get url
        $result = $product->getResponse();

        //check size
        $this->assertTrue(!empty($result['size']));

        //check description
        $this->assertTrue($result['description'] === 'Sweet & Juicy Blush Pears');
    }
}
