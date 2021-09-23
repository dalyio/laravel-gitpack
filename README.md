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

### Initialize

Initialize the git repository using the default information provided in the `git.php` configuration file.

``` bash
php artisan git:init -p dalyio/laravel-gitpack
```

Or provide new credentials.

``` bash
php artisan git:init -p dalyio/laravel-gitpack -u dalyio -e dalyio.mail@gmail.com 
```

### Status

Check the status of all your configured local development packages.

``` bash
php artisan git:status
```

And the output will display for each package.

``` bash
packages/dalyio/gitpack/
On branch master
Changes not staged for commit:
  (use "git add <file>..." to update what will be committed)
  (use "git restore <file>..." to discard changes in working directory)
        modified:   README.md

no changes added to commit (use "git add" and/or "git commit -a")
```

### Pull

Pull all your configured local development packages.

``` bash
php artisan git:pull
```

Or specify a single package to pull from.

``` bash
php artisan git:pull -p dalyio/laravel-gitpack
```

### Push

Commit and push changes to all your configured local development packages.

``` bash
php artisan git:push -m "your commit message here"
```

Or specify a single package to commit and push to.

``` bash
php artisan git:push -p dalyio/laravel-gitpack -m "your commit message here"
```

## Errors

If a git error occurs during any of the above processes it is recommended that you navigate to the source of your local development package and use native git commands to resolve any issues.

## License

Laravel Gitpack is open-sourced software licensed under the [MIT license](LICENSE).
