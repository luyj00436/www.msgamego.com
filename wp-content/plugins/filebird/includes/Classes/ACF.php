<?php

namespace FileBird\Classes;

defined('ABSPATH') || exit;

class ACF
{
    protected static $instance = null;

    function __construct()
    {

    }

    public static function getInstance()
    {
        if (null == self::$instance) {
            self::$instance = new self;
            self::$instance->doHooks();
        }
        return self::$instance;
    }

    private function doHooks()
    {
        add_action('acf/include_field_types', array($this, 'include_field')); // v5
        add_action('acf/register_fields', array($this, 'include_field')); // v4
    }

    function include_field($version = false)
    {
        if (!$version) $version = 4;
        include_once('ACF/acf-field-filebird-v' . $version . '.php');
    }
}