<?php

namespace Standard\Uniform;

use Standard\PostType;

interface PostTypes
{
    public function setTranslations($single = 'Post', $plural = 'Posts'): PostType;

    public function customIcon($icon = 'dashicons-admin-post'): PostType;

    public function register($slug, $description): PostType;

    public function init($priority = 0): PostType;

    public function new(): PostType;
}