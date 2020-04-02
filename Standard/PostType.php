<?php

namespace Standard;

use Standard\Uniform\PostTypes as Type;

class PostType implements Type
{
    protected $labels;
    protected $slug;

    public $supports = ['title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'];

    public $hierarchical = false;
    public $public = true;
    public $show_ui = true;
    public $show_in_menu = true;
    public $show_in_nav_menus = true;
    public $show_in_admin_bar = true;
    public $menu_position = 5;
    public $menu_icon = 'dashicons-admin-post';
    public $can_export = true;
    public $has_archive = false;
    public $exclude_from_search = false;
    public $publicly_queryable = true;
    public $capability_type = 'post';
    public $show_in_rest = true;

    protected $callback;

    public function setTranslations($single = 'Post', $plural = 'Posts'): PostType
    {
        $this->labels = [
            'name' => _x($plural, 'Post Type General Name'),
            'singular_name' => _x($single, 'Post Type Singular Name'),
            'menu_name' => __($plural),
            'parent_item_colon' => __('Parent ' . $single),
            'all_items' => __('All ' . $plural),
            'view_item' => __('View ' . $single),
            'add_new_item' => __('Add New ' . $single),
            'add_new' => __('Add New'),
            'edit_item' => __('Edit ' . $single),
            'update_item' => __('Update ' . $single),
            'search_items' => __('Search ' . $single),
            'not_found' => __('Not Found'),
            'not_found_in_trash' => __('Not found in Trash')
        ];
        return $this;
    }

    public function customIcon($icon = 'dashicons-admin-post'): PostType
    {
        $this->menu_icon = $icon;
        return $this;
    }

    public function register($slug = 'custom_post_type', $description = '', $taxonomies = []): PostType
    {
        $this->slug = $slug;
        $args = [
            'label' => __($slug),
            'description' => __($description),
            'labels' => $this->labels,
            'supports' => $this->supports,
            'taxonomies' => $taxonomies,
            'hierarchical' => $this->hierarchical,
            'public' => $this->public,
            'show_ui' => $this->show_ui,
            'menu_icon' => $this->menu_icon,
            'show_in_menu' => $this->show_in_menu,
            'show_in_nav_menus' => $this->show_in_nav_menus,
            'show_in_admin_bar' => $this->show_in_admin_bar,
            'menu_position' => $this->menu_position,
            'can_export' => $this->can_export,
            'has_archive' => $this->has_archive,
            'exclude_from_search' => $this->exclude_from_search,
            'publicly_queryable' => $this->publicly_queryable,
            'capability_type' => $this->capability_type,
            'show_in_rest' => $this->show_in_rest,

        ];
        $this->callback = function () use ($args, $slug) {
            register_post_type($slug, $args);
        };

        return $this;


    }

    public function init($priority = 0): PostType
    {
        add_action('init', $this->callback, $priority);

        return $this;
    }

    public function registerTaxonimies($single, $plural)
    {
        (new Taxonomies($this->slug))->register($single, $plural)->init();
        return $this;
    }

    public function new(): PostType
    {
        return new self;
    }
}