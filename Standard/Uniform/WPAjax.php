<?php


namespace Standard\Uniform;


interface WPAjax
{
    public function setAction($action, $callback);

    public function setAuthAction($action, $callback);

    public function setActionAll($action, $callback);
}