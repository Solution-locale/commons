# Solution locale commons

## Installation

1. Require package
2. Add an entry to `config/database.php` connections like so:

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
