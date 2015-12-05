<?php

namespace Test\Functional\Library\Common;
use \Test;

/**
 * Class Curl
 * @package Test\Functional\Library\Common
 */
class Curl extends Test\Base
{
    /**
     * This will test the \Library\Common\Curl get() and getResponse() methods
     */
    public function testGet()
    {
        //set url
        $url = $this->getHostname().'test/curl';

        //set params
        $params = array('field1' => 'value1');

        //get curl class
        $curl = $this->getDi()['\Library\Common\Curl'];

        //execute curl request
        $curl->get($url, $params);

        //get curl response
        $results = json_decode($curl->getResponse(), true);

        //test get response
        $this->assertTrue(isset($results['data']) && !empty($results['data']) ? true : false);

        //test url
        $this->assertTrue(isset($results['data']['url']) && $results['data']['url'] === '/test/curl?field1=value1' ? true : false);

        //test get params
        $this->assertTrue(isset($results['data']['params']['get']) && $results['data']['params']['get'] === array('field1' => 'value1') ? true : false);
    }
}
