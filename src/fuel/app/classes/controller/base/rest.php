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
}
