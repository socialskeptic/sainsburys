<?php

namespace Controller\Base;
use \Library;

/**
 * Class Rest
 * @package Controller\Base
 */
class Rest extends \Controller_Rest
{
    /**
     * This is to set the output format (json, html)
     * @var string
     */
    public $format = 'json';

    /**
     * This is for the Main DI Containers
     * @var \Pimple\Container
     */
    public $di;

    /**
     * This will set the DI Container before the controller loads
     */
    public function before()
    {
        parent::before();

        //init di containers
        $di = new Library\Di;
        $this->setDi($di->getDi());
    }

    /**
     * getFormat:
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * setFormat:
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * getDi:
     * @return \Pimple\Container
     */
    public function getDi()
    {
        return $this->di;
    }

    /**
     * setDi:
     * @param \Pimple\Container $di
     */
    public function setDi($di)
    {
        $this->di = $di;
    }
}
