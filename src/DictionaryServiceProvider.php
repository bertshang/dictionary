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
    protected $defer = true;
    public function boot()
    {
        if ($this->app->runningInConsole()) {
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
        $this->app->singleton(Dictionary::class, function(){
            return new Dictionary();
        });

        $this->app->alias(Dictionary::class, 'dictionary');
        //$this->app->bind('dictionary', Dictionary::class);
    }

    public function provides()
    {
        return [Dictionary::class, 'dictionary'];
    }
}