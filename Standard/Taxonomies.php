<?php


namespace Standard;


class Taxonomies
{
    public $hierarchical = true;
    public $show_ui = true;
    public $show_admin_column = true;
    public $query_var = true;


    protected $single;
    protected $plural;
    protected $slugs = [];


    private $callback;

    public function __construct($postTypeSlug)
    {
        if (is_array($postTypeSlug)) {
            $this->slugs = $postTypeSlug;
        }
        if (is_string($postTypeSlug)) {
            $this->slugs[] = $postTypeSlug;
        }
    }

    public function register($single, $plural): Taxonomies
    {
        $this->single = $single;
        $this->plural = $plural;
        // Add new taxonomy, make it hierarchical (like categories)
        $labels = [
            'name' => _x($this->single, 'taxonomy general name', 'textdomain'),
            'singular_name' => _x($this->single, 'taxonomy singular name', 'textdomain'),
            'search_items' => __('Search ' . $this->plural, 'textdomain'),
            'all_items' => __('All ' . $this->plural, 'textdomain'),
            'parent_item' => __('Parent ' . $this->single, 'textdomain'),
            'parent_item_colon' => __('Parent ' . $this->single . ':', 'textdomain'),
            'edit_item' => __('Edit ' . $this->single, 'textdomain'),
            'update_item' => __('Update ' . $this->single, 'textdomain'),
            'add_new_item' => __('Add New ' . $this->single, 'textdomain'),
            'new_item_name' => __('New ' . $this->single . ' Name', 'textdomain'),
            'menu_name' => __($this->single, 'textdomain'),
        ];

        $args = [
            'hierarchical' => $this->hierarchical,
            'labels' => $labels,
            'show_ui' => $this->show_ui,
            'show_admin_column' => $this->show_admin_column,
            'query_var' => $this->query_var,
            'rewrite' => array('slug' => strtolower($this->single)),
        ];

        $this->callback = function () use ($args) {
            register_taxonomy(strtolower($this->single), $this->slugs, $args);
        };

        return $this;
    }

    public function init()
    {
        add_action('init', $this->callback, 0);
    }
}