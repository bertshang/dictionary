<?php

namespace Bertshang\Dictionary;

use Illuminate\Support\ServiceProvider;
use Bertshang\Dictionary\Console\CacheClearCommand;
/**
 * Class DictionaryServiceProvider
 * @package Bertshang\Dictionary
 */
class DictionaryServiceProvider extends ServiceProvider {
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runninmigrationsgInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'migrations');

            $this->commands([
                CacheClearCommand::class
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind('dictionary', Dictionary::class);
    }
}