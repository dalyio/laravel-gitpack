# Laravel Git Helper for Packages Development
A package for Laravel to perform basic git commands on locally integrated development packages.

## Installation

``` bash
composer require dalyio/laravel-gitpack
```

``` bash
php artisan vendor:publish --provider="Dalyio\Gitpack\Providers\GitpackServiceProvider"
```

## Configuration

Edit the new `git.php` configuration file in the config directory to match your git credentials and repositories.

```php
    'username' => '{GIT USERNAME}',
    
    'email' => '{GIT EMAIL}',
    
    'message' => '{DEFAULT COMMIT MESSAGE}',
    
    'packages' => [
        '{GIT VENDOR / REPOSITORY}' => '{PATH TO LOCAL DEVELOPMENT PACKAGE}',
        'dalyio/laravel-gitpack' => 'packages/dalyio/gitpack/',
    ],
```

## Usage

Enter usage examples here

## License

Laravel Gitpack is open-sourced software licensed under the [MIT license](LICENSE).
