# Solution locale commons

## Installation

### Require package (required)

This package is not distributed with Packagist. To use it, you will need to add this repository as a source in your `composer.json` file like so:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/Solution-locale/commons"
    }
],
```

When it's done, add `"solutionlocale/commons": "^1.0"` to `required` in your `composer.json` file and update.

### Database (required)

This package assume that you have access to the main Solution Local database and will expect a database connection named `solutionlocale`in your `config/database.php` file. Those are the parameters for this connection:

```php
'solutionlocale' => [
    'driver' => 'mysql',
    'url' => env('DATABASE_URL'),
    'host' => env('SOLUTIONLOCALE_DB_HOST'),
    'port' => env('SOLUTIONLOCALE_DB_PORT'),
    'database' => env('SOLUTIONLOCALE_DB_DATABASE'),
    'username' => env('SOLUTIONLOCALE_DB_USERNAME'),
    'password' => env('SOLUTIONLOCALE_DB_PASSWORD'),
    'unix_socket' => env('SOLUTIONLOCALE_DB_SOCKET'),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'prefix_indexes' => true,
    'strict' => true,
    'engine' => null,
    'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
    ]) : [],
],
```

### "Ultra local" setup (optional)

If you wish to use the commons in an "ultra local" setup (meaning the site will only operate within specified RCMs), you will have to enable it in your environment file like this:

```
SOLUTION_LOCALE_ULTRA_ENABLED=true
# Below is the comma separated list of RCM IDs you want to show in this instance
SOLUTION_LOCALE_ULTRA_RCM_IDS="22,25"
```
