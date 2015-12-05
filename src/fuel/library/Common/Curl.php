<?php

namespace Library;

/**
 * Class Curl - This is a wrapper class for the 3rd Party class \Curl\Curl.
 * This file contains custom settings for curl get method, and also has a defined method for getResponse().
 * @package App\Library
 */
class Curl extends \Curl\Curl
{
    /**
     * This will execute a curl get request with set options for cookies, follow location and user agent etc.
     * @param $url
     * @param array $data
     * @throws \Exception
     */
    public function get($url, $data = array())
    {
        try
        {
            //disable http header in response.
            $this->setopt(CURLOPT_HEADER, false);

            //enable cookies storage.
            $this->setOpt(CURLOPT_COOKIESESSION, true);
            $this->setOpt(CURLOPT_COOKIEJAR, '../App/Tmp/cookies.txt');
            $this->setOpt(CURLOPT_COOKIEFILE, '../App/Tmp/cookies.txt');

            //follow location redirects.
            $this->setOpt(CURLOPT_FOLLOWLOCATION, true);

            //set user agent.
            $this->setOpt(CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
            parent::get($url, $data = array());

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * This will return the curl response data.
     * @return null
     * @throws \Exception
     */
    public function getResponse()
    {
        try
        {
            //check if response key exists.
            if (!isset($this->response)) {
                throw new \Exception('response key is not set');
            } else {

                //return response.
                return $this->response;
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
