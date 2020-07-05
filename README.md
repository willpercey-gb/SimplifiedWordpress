# SimplifiedWordpress

### Hasing
```php
$hash = new \UWebPro\WordPress\Hash(SECURE_AUTH_SALT, 8);
$hash->encode($post->ID);
//
$hash->decode($post->ID);
```
### Ajax

```php
$ajax = new \UWebPro\WordPress\WPAjax();
```