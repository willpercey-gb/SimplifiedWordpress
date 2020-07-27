# SimplifiedWordpress

### Duplicator
```php
(new \UWebPro\WordPress\Duplicator());

// Using Advanced Custom Fields or need to exlude post types?
(new UWebPro\WordPress\Duplicator())->exclude(['acf-field-group']);
```

### Ajax
```php
$ajax = new \UWebPro\WordPress\WPAjax();

$ajax->setAction('load_more', {callback});

$ajax->setAuthAction('save_forms', {callback});

$ajax->setActionAll('get_availabilities', 'function callback here');
```

### Cron Scheduler

```php
$cron = new WPSchedule();
$cron->schedule({callback})->hourly();
```

### Custom Post Types
```php
class PostTypes
{
    public const WHATS_ON = 'whats_on';
    public const SEE_AND_DO = 'see_and_do';
    public const STAY_OVER = 'stay_over';

    public const WHATS_ON_CATEGORY = 'event_type';
    public const SEE_AND_DO_CATEGORY = 'attraction_type';
    public const STAY_OVER_CATEGORY = 'establishment_type';

    public function __construct()
    {
        $types = new \UWebPro\WordPress\PostType();

        $types->new()->setTranslations('What\'s On', 'What\'s On')
            ->customIcon('dashicons-calendar-alt')
            ->register(self::WHATS_ON)
            ->registerTaxonimies('Event Type', 'Event Types')
        ->init();

        $types->new()->setTranslations('See and Do', 'See and Do')
            ->customIcon('dashicons-tickets')
            ->register(self::SEE_AND_DO)
            ->registerTaxonimies('Attraction Type', 'Attraction Types')
        ->init();


        $types->new()->setTranslations('Stay Over', 'Stay Over')
            ->customIcon('dashicons-admin-multisite')
            ->register(self::STAY_OVER)
            ->registerTaxonimies('Establishment Type', 'Establishment Types')
        ->init();
    //custom taxonomies
    (new \UWebPro\Wordpress\Taxonomies('post'))->register('Story Type', 'Story Types')->init();


    }
}
```


### Hashing IDs / Numbers
```php
$hash = new \UWebPro\WordPress\Hash(SECURE_AUTH_SALT, 8);
$hash->encode($post->ID);
//
$hash->decode($post->ID);

// Want a random string?
$hash->str_rand();
```
