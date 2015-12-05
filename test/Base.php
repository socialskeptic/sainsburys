<?php

namespace Test;
use \Library;

/**
 * Class Base
 * @package Test
 */
class Base extends \PHPUnit_Framework_TestCase
{
    /**
     * This should be set to the Pimple DI containers.
     * @var \Pimple\Container
     */
    public $di;

    /**
     * This should be set to the hostname to be used for testing. (http://www.example.com/)
     * requires trailing slash.
     * @var string
     */
    public $hostname = 'http://local.test.com/';

    /**
     * This will initialize the DI containers.
     */
    public function __construct()
    {
        parent::__construct();
        $di = new Library\Di;
        $this->setDi($di->getDi());
    }

    /**
     * This is a dummy test (at least 1 test is required in each class)
     */
    public function testDummy()
    {
        $this->assertTrue(true);
    }

    /**
     * This is a simple dump method for general debugging purposes.
     * @param $data
     * @param bool $exit
     */
    public function dump($data, $exit = false)
    {
        print '<pre>';
        print_r($data);
        print '</pre>';

        if($exit) {
            exit;
        }
    }

    /**
     * This will get the DI Containers.
     * @return \Pimple\Container
     */
    public function getDi()
    {
        return $this->di;
    }

    /**
     * This will set the DI Containers.
     * @param \Pimple\Container $di
     */
    public function setDi($di)
    {
        $this->di = $di;
    }

    /**
     * This will get the set hostname for testing.
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * This will set the hostname for testing.
     * @param string $hostname
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
    }
}
