<?php

namespace Product;
use \Asymptix\HtmlDomParser\HtmlDomParser;
use \Library;


/**
 * Class Product - This class can be used to collect
 * @package Product
 */
class Product
{
    /**
     * $url: This should be set to the product list ajax url.
     * @var string
     */
    public $url;


    public function getProductInfo()
    {
        $data = array();

        $curl = new Library\Curl();
        $curl->get($this->getUrl());
        $response = $curl->getResponse();

        $parser = new HtmlDomParser();
        $parser->loadstring($response);

        $data['size'] = strlen($response);

        $strings = array();
        foreach($parser->find('#information .productText p') as $product) {
            $strings[] = $product->plaintext;

        }

        if(!empty($strings[0])) {
            $data['description'] = $strings[0];
        }

        return $data;
    }

    /**
     * getUrl: get ajax request url.
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * setUrl: set ajax request url.
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}
