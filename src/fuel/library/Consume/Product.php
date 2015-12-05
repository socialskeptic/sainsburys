<?php

namespace Library\Consume;
use \Library;
use \Asymptix\HtmlDomParser\HtmlDomParser;

/**
 * Class Product - This class can be used to extract individual product information from the sainsbury's website
 * @package Library\Consume
 */
class Product
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
     * This will initialize curl via DI.
     * @param Library\Common\Curl $curl
     */
    public function __construct(Library\Common\Curl $curl)
    {
        //init curl
        $this->setCurl($curl);
    }

    /**
     * This will extract individual product information.
     * @return array
     */
    public function getResponse()
    {
        //set initial data response
        $data = array();

        //get curl response
        /** @var \Library\Common\Curl $curl */
        $curl = $this->getCurl();
        $curl->get($this->getUrl());
        $response = $curl->getResponse();

        //parse response html dom
        $parser = new HtmlDomParser();
        $parser->loadstring($response);

        //get html filesize
        $data['size'] = strlen($response);

        //get product description information
        $strings = array();
        foreach($parser->find('#information .productText p') as $product) {
            $strings[] = $product->plaintext;
        }
        if(!empty($strings[0])) {
            $data['description'] = $strings[0];
        }

        //return html size and description in array
        return $data;
    }

    /**
     * This will get the curl instance.
     * @return Library\Common\Curl
     */
    public function getCurl()
    {
        return $this->curl;
    }

    /**
     * This will set the curl instance.
     * @param Library\Common\Curl $curl
     */
    public function setCurl($curl)
    {
        $this->curl = $curl;
    }

    /**
     * This will get the curl request url.
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * This will set the curl request url.
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}
