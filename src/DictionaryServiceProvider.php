<?php

/*
 * This file is part of the bertshang/dictionary.
 *
 * (c) bertshang <359352960@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bertshang\Dictionary;

use Illuminate\Support\ServiceProvider;
use Bertshang\Dictionary\Console\CacheClearCommand;

/**
 * Class DictionaryServiceProvider.
 */
class DictionaryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    protected $defer = true;

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'migrations');

            $this->commands([
                CacheClearCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(Dictionary::class, function () {
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
