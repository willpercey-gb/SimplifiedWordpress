<?php


namespace UWebPro\WordPress;

use UWebPro\WordPress\Uniform\WPAjax as Ajax;

class WPAjax implements Ajax
{
    public function setAuthAction($action, $callback): self
    {
        add_action('wp_ajax_' . $action, $callback);
        return $this;
    }

    public function setAction($action, $callback): self
    {
        add_action('wp_ajax_nopriv_' . $action, $callback);
        return $this;
    }

    public function setActionAll($action, $callback): self
    {
        $this->setAction($action, $callback);
        return $this->setAuthAction($action, $callback);
    }

    public function cleanQuery(): self
    {
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $_GET[$key] === 'null' ? null : $value;
        }
        return $this;
    }

    public function isJson($string): bool
    {
        json_decode($string);
        return (json_last_error() === JSON_ERROR_NONE);
    }
}