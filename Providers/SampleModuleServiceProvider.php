<?php

namespace Modules\SampleModule\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

define('SAMPLE_MODULE', 'samplemodule');

class SampleModuleServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        // Sample filter
        \Eventy::addFilter('dashboard.before', function($value) {
            return $value.'<p>'.\Module::getOption(SAMPLE_MODULE, 'dashboard_text').'</p>';
        }, 20, 1);

        // Sample action listener
        \Eventy::addAction('non_existent_action', function($value) {
            // Do nothing
        }, 20, 1);

        // Add module's css file to the application layout
        \Eventy::addFilter('stylesheets', function($value) {
            array_push($value, '/modules/'.SAMPLE_MODULE.'/css/style.css');
            return $value;
        }, 20, 1);

        // Add script with translated vars
        \Eventy::addFilter('javascripts', function($value) {
            array_push($value, '/modules/'.SAMPLE_MODULE.'/js/vars.js');
            return $value;
        }, 20, 1);

        // Add routes script
        \Eventy::addFilter('javascripts', function($value) {
            array_push($value, '/modules/'.SAMPLE_MODULE.'/js/laroute.js');
            return $value;
        }, 20, 1);

        // Add module's JS file to the application layout
        \Eventy::addFilter('javascripts', function($value) {
            array_push($value, '/modules/'.SAMPLE_MODULE.'/js/main.js');
            return $value;
        }, 20, 1);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('samplemodule.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'samplemodule'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/samplemodule');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/samplemodule';
        }, \Config::get('view.paths')), [$sourcePath]), 'samplemodule');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/samplemodule');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'samplemodule');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'samplemodule');
        }
    }

    /**
     * Register an additional directory of factories.
     * @source https://github.com/sebastiaanluca/laravel-resource-flow/blob/develop/src/Modules/ModuleServiceProvider.php#L66
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
