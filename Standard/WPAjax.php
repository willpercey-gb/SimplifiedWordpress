<?php


namespace Standard;

use Standard\Uniform\WPAjax as Ajax;

class WPAjax implements Ajax
{
    public function setAuthAction($action, $callback)
    {
        add_action('wp_ajax_' . $action, $callback);
        return $this;
    }

    public function setAction($action, $callback)
    {
        add_action('wp_ajax_nopriv_' . $action, $callback);
        return $this;
    }

    public function setActionAll($action, $callback)
    {
        $this->setAction($action, $callback);
        return $this->setAuthAction($action, $callback);
    }

    public function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}