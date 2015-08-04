<?php

namespace minkbear\Setting;

use Illuminate\Support\ServiceProvider;
use minkbear\Setting\interfaces\LaravelFallbackInterface;

class SettingServiceProvider extends ServiceProvider {

  /**
   * Indicates if loading of the provider is deferred.
   *
   * @var bool
   */
  protected $defer = false;

  /**
   * Bootstrap the application events.
   *
   * @return void
   */
  public function boot() {
    $this->publishes([
            __DIR__ . '/../../config/setting.php' => config_path('setting.php'),
    ]);
  }

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register() {
    $this->mergeConfigFrom(__DIR__ . '/../../config/setting.php', 'setting');
    $this->app->bind('Setting', function($app) {
      $path = $app['config']['setting.path'];
      $filename = $app['config']['setting.filename'];

      return new Setting($path, $filename, $app['config']['setting.fallback'] ? new LaravelFallbackInterface() : null);
    });

    $this->app->booting(function($app) {
      if ($app['config']['setting.autoAlias']) {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Setting', 'minkbear\Setting\Facades\Setting');
      }
    });
  }
}
