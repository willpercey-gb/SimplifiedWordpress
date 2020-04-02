<?php


namespace Standard;


class Taxonomies
{
    public $hierarchial = true;
    public $show_ui = true;
    public $show_admin_column = true;
    public $query_var = true;
    public $rewrite;


    protected $single;
    protected $plural;
    protected $slug;


    /**
     * @var \Closure
     */
    private $callback;

    public function __construct(string $postTypeSlug)
    {
        $this->slug = $postTypeSlug;
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
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => strtolower($this->single)),
        ];

        $this->callback = function () use ($args) {
            register_taxonomy($this->slug, strtolower($this->single), $args);
        };

        return $this;
    }

    public function init()
    {
        add_action('init', $this->callback, 0);
    }
}