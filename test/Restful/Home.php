<?php

namespace Test\Restful;
use \Test;

/**
 * Class Home
 * @package Test\Restful
 */
class Home extends Test\Base
{
    /**
     * This will test the main home page json response
     */
    public function testActionIndex()
    {
        //get url
        $url = $this->getHostname();

        //get curl instance
        $curl = $this->getDi()['\Library\Common\Curl'];

        //execute curl request
        $curl->get($url);

        //get response
        $results = json_decode($curl->getResponse(), true);

        //check for results
        //$this->assertTrue(!empty($results));

        if(!empty($results)) {
            foreach($results as $result) {

                //check titles
                $this->assertTrue(isset($result['title']) && !empty($result['title']));

                //check unit prices
                $this->assertTrue(isset($result['unit_price']) && !empty($result['unit_price']));

                //check sizes
                $this->assertTrue(isset($result['size']) && !empty($result['size']));

                //check descriptions
                $this->assertTrue(isset($result['description']) && !empty($result['description']));
            }
        }
    }
}
