# Laravel Git Helper for Packages Development

A package for Laravel to perform basic git commands on locally integrated development packages.  If working within multiple local development packages or repositories at once this package is meant to ease the burden of navigating to each individual repository to perform basic git commands.

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
return [
    'username' => '{DEFAULT GIT USERNAME}',
    'email' => '{DEFAULT GIT EMAIL}',
    'message' => '{DEFAULT COMMIT MESSAGE}',
    
    'packages' => [
        '{VENDOR/REPOSITORY}' => '{PATH TO LOCAL DEVELOPMENT PACKAGE}',
        'dalyio/laravel-gitpack' => 'packages/dalyio/gitpack/',
    ],
]
```

## Usage

### Initialize

Initialize the git repository using the default information provided in the `git.php` configuration file.

``` bash
php artisan git:init -p {VENDOR/REPOSITORY}
```

Or provide new credentials.

``` bash
php artisan git:init -p {VENDOR/REPOSITORY} -u {GIT USERNAME} -e {GIT EMAIL}
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
php artisan git:pull -p {VENDOR/REPOSITORY}
```

### Push

Commit and push changes to all your configured local development packages.

``` bash
php artisan git:push -m "{COMMIT MESSAGE}"
```

Or specify a single package to commit and push to.

``` bash
php artisan git:push -p {VENDOR/REPOSITORY} -m "{COMMIT MESSAGE}"
```

## Branches

When performing any of the above commands, Laravel Gitpack will detect the local development package's current branch and perform the operation using the current branch.  To change branches or to perform more complex git branch operations, it is recommended that you navigate to the source of your local development package and use native git commands to resolve any issues.

## Errors

If a git error occurs during any of the above processes it is recommended that you navigate to the source of your local development package and use native git commands to resolve any issues.

## License

Laravel Gitpack is open-sourced software licensed under the [MIT license](LICENSE).
