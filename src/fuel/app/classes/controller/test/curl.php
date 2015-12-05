<?php

namespace Controller\Test;
use Controller;
use \Library;

/**
 * Class Curl
 * @package Controller\Test
 */
class Curl extends Controller\Base\Rest
{
    /**
     * This is a test page to test basic curl requests and responses.
     * @return mixed
     */
    public function action_index()
    {
        try
        {
            //init data response
            $data = array();

            //get url
            $data['url'] = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

            //get method
            $data['method'] = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '';

            //get params
            $data['params']['get'] = \Input::get();
            $data['params']['post'] = \Input::post();
            $data['params']['put'] = \Input::put();
            $data['params']['delete'] = \Input::delete();

            //return response
            $this->response(array('data' => $data));

        } catch (\Exception $e) {

            //return caught exceptions to json response
            $this->response(array('exception' => $e->getMessage()));
        }
    }
}
