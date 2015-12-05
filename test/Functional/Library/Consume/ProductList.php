<?php

namespace Test\Functional\Library\Consume;
use \Test;
use \Library;

/**
 * Class ProductList
 * @package Test\Functional\Library\Consume
 */
class ProductList extends Test\Base
{
    /**
     * This will check if the curl instance is being set correctly.
     */
    public function testCurl()
    {
        //get productsList instance
        /** @var \Library\Consume\ProductList $productList */
        $productList = $this->getDi()['\Library\Consume\ProductList'];

        //get curl instance
        $result = $productList->getCurl();

        //check curl instance
        $this->assertTrue($result instanceof Library\Common\Curl);
    }

    /**
     * This will check if the url property works ok.
     */
    public function testUrl()
    {
        //get productsList instance
        /** @var \Library\Consume\ProductList $productList */
        $productList = $this->getDi()['\Library\Consume\ProductList'];

        //set url
        $productList->setUrl('http://www.test.com');

        //get url
        $result = $productList->getUrl();

        //check url was set correctly
        $this->assertTrue($result === 'http://www.test.com');
    }

    /**
     * This will test the getResponse method.
     */
    public function testGetResponse()
    {
        //set request url
        $url = 'http://www.sainsburys.co.uk/webapp/wcs/stores/servlet/AjaxApplyFilterBrowseView?langId=44&storeId=10151&catalogId=10137&categoryId=185749&parent_category_rn=12518&top_category=12518&pageSize=20&orderBy=FAVOURITES_FIRST&searchTerm=&beginIndex=0&hideFilters=true';

        //get productsList instance
        /** @var \Library\Consume\ProductList $productList */
        $productList = $this->getDi()['\Library\Consume\ProductList'];

        //set url
        $productList->setUrl($url);

        //get results
        $results = $productList->getResponse();

        //check if results were returned
        $this->assertTrue(isset($results) && !empty($results));

        //check each result has valid data
        if(!empty($results)) {
            foreach($results as $result) {

                //check titles
                $this->assertTrue(isset($result['title']) && !empty($result['title']));

                //check href
                $this->assertTrue(isset($result['href']) && !empty($result['href']));

                //check unit prices
                $this->assertTrue(isset($result['unit_price']) && !empty($result['unit_price']));
            }
        }
    }

    /**
     * This will test the getProductsList method.
     */
    public function testGetProductsList()
    {
        //set request url
        $url = 'http://www.sainsburys.co.uk/webapp/wcs/stores/servlet/AjaxApplyFilterBrowseView?langId=44&storeId=10151&catalogId=10137&categoryId=185749&parent_category_rn=12518&top_category=12518&pageSize=20&orderBy=FAVOURITES_FIRST&searchTerm=&beginIndex=0&hideFilters=true';

        //get productsList instance
        /** @var \Library\Consume\ProductList $productList */
        $productList = $this->getDi()['\Library\Consume\ProductList'];

        //set url
        $productList->setUrl($url);

        //get results
        $results = $productList->getProductsList();

        //check if results were returned
        $this->assertTrue(isset($results) && !empty($results));

        //iterate over results
        if(!empty($results)) {
            foreach($results as $result) {

                //get first 21 chars from each html row
                $subString = substr($result, 0, 21);

                //check if html contains the gridItem li element
                $this->assertTrue($subString === '<li class="gridItem">');
            }
        }
    }

    /**
     * This will test the getProductInfo method.
     */
    public function testGetProductInfo()
    {
        //set request url
        $url = 'http://www.sainsburys.co.uk/webapp/wcs/stores/servlet/AjaxApplyFilterBrowseView?langId=44&storeId=10151&catalogId=10137&categoryId=185749&parent_category_rn=12518&top_category=12518&pageSize=20&orderBy=FAVOURITES_FIRST&searchTerm=&beginIndex=0&hideFilters=true';

        //get productsList instance
        /** @var \Library\Consume\ProductList $productList */
        $productList = $this->getDi()['\Library\Consume\ProductList'];

        //set url
        $productList->setUrl($url);

        //get results
        $results = $productList->getProductsList();

        //check if products has entries
        if(!empty($results)) {

            //iterate over products list
            foreach($results as $html) {

                //get each product information
                $productInfo = $productList->getProductInfo($html);

                //check titles
                $this->assertTrue(isset($productInfo['title']) && !empty($productInfo['title']));

                //check href
                $this->assertTrue(isset($productInfo['href']) && !empty($productInfo['href']));

                //check unit prices
                $this->assertTrue(isset($productInfo['unit_price']) && !empty($productInfo['unit_price']));

            }
        }
    }
}
