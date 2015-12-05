<?php

namespace Library\Consume;
use \Library;
use \Asymptix\HtmlDomParser\HtmlDomParser;

/**
 * Class ProductList - This class will return an custom formatted products list.
 * @package Library\Consume
 */
class ProductList
{
    /** This should contain an instance of Curl
     * @var \Library\Common\Curl
     */
    public $curl;

    /**
     * This should be set to the product list ajax url.
     * @var string
     */
    public $url;

    /**
     * This will set curl via DI
     * @param Library\Common\Curl $curl
     */
    public function __construct(Library\Common\Curl $curl)
    {
        //init curl
        $this->setCurl($curl);
    }

    /**
     * This will extract a list of products from the sainsbury's website
     * @return array
     */
    public function getResponse()
    {
        //init products array
        $products = array();

        //get products list
        $productsList = $this->getProductsList();

        //check if products has entries
        if(!empty($productsList)) {

            //iterate over products list
            foreach($productsList as $html) {

                //get each product information
                $products[] = $this->getProductInfo($html);
            }
        }

        //return products list
        return $products;
    }

    /**
     * This will get the products list ajax response.
     * @throws \Exception
     */
    public function getProductsList()
    {
        //set default products list.
        $productsList = array();

        //get initial ajax response using curl.
        $curl = $this->getCurl();
        $curl->get($this->getUrl());
        $response = $curl->getResponse();

        //encode response to utf8.
        $response = utf8_encode($response);

        //convert json to array.
        $results = json_decode($response, true);

        //iterate over integer keyed array.
        if(!empty($results)) {
            foreach($results as $row) {

                //find productLists key
                if(isset($row['productLists'])) {

                    //get products list
                    $productsList = $row['productLists'][0]['products'];
                }
            }
        }

        //re-arrange products list array to be formatted as (numeric key => html)
        if(!empty($productsList)) {
            foreach($productsList as $key => $value) {
                $productsList[$key] = $value['result'];
            }
        }

        //return products list
        return $productsList;
    }

    /**
     * This will get the basic product information from the product list html snippet response
     * @param $html
     * @return array
     */
    public function getProductInfo($html)
    {
        //parse html dom
        $parser = new HtmlDomParser();
        $parser->loadstring($html);

        //init default productInfo array
        $productInfo = array();

        //set product incrementer
        $i=0;

        //iterate over .product classes
        foreach($parser->find('.product') as $product) {

            //iterate over .productInfo a elements
            foreach($product->find('.productInfo a') as $a) {

                //get product title
                $productInfo['title'] = trim($a->plaintext);

                //get product href
                $productInfo['href'] = trim($a->href);

                //use first anchor tag result only
                break;
            }

            //iterate over .pricePerUnit class
            foreach($parser->find('.pricePerUnit') as $pricePerUnit) {

                //get product unit price.
                $unitPrice = $pricePerUnit->plaintext;
                $unitPrice = str_replace('/unit', '', $unitPrice);
                $unitPrice = str_replace('£', '', $unitPrice);
                $productInfo['unit_price'] = trim($unitPrice);

            }
            $i++;
        }

        //return product title, href, and unit price
        return $productInfo;
    }

    /**
     * This will get the curl instance.
     * @return \Library\Common\Curl
     */
    public function getCurl()
    {
        return $this->curl;
    }

    /**
     * This will set the curl instance.
     * @param \Library\Common\Curl $curl
     */
    public function setCurl($curl)
    {
        $this->curl = $curl;
    }

    /**
     * This will get the request url.
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * This will set the request url.
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}
