<?php

namespace Dalyio\Gitpack\Providers;

use Illuminate\Support\ServiceProvider;

class GitpackServiceProvider extends ServiceProvider
{    
    /**
     * @return void
     */
    public function register()
    {
        $this->publishes([
            realpath(__DIR__.'/../../config/git.php') => config_path('git.php'),
        ]);
    }

    /**
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Dalyio\Gitpack\Console\Commands\GitInit::class,
                \Dalyio\Gitpack\Console\Commands\GitPull::class,
                \Dalyio\Gitpack\Console\Commands\GitPush::class,
                \Dalyio\Gitpack\Console\Commands\GitStatus::class,
            ]);
        }
    }
    
    /**
     * Merge the given configuration with the existing configuration.
     *
     * @param  array $config
     * @return void
     */
    protected function mergeConfig($configs)
    {
        if (!$this->app->configurationIsCached()) {
            foreach ($configs as $path => $namespace) {
                $this->app['config']->set($namespace, array_merge_recursive(
                    $this->app['config']->get($namespace, []), require $path
                ));
            }
        }
    }
}
