<?php
namespace Comnect\Smarty;

use Illuminate\Support\ServiceProvider;
use Illuminate\View;

/**
 * SmartyServiceProvider
 * @author yuuki.takezawa <yuuki.takezawa@comnect.jp.net>
 * @package Smarty
 * @license MIT
 */
class SmartyServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 * @var bool
	 */
	protected $defer = false;

    /**
	 * Bootstrap the application events.
	 * @return void
	 */
	public function boot()
	{
		$this->package('comnect/smarty');
        $this->registerSmartyEngine();
        $this->registerCommands();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        // smarty configure register
        $this->app['config']->package('comnect/smarty', __DIR__.'/../config');
	}

	/**
	 * register smarty engine
	 * @return Engines\SmartyEngine
	 */
	public function registerSmartyEngine()
	{
		$app = $this->app;

        $app->bind('Illuminate\View\Engines\EngineInterface', 'Comnect\Smarty\Engines\SmartyEngine');
		// share
		$app['view'] = $app->share(function ($app) {
			    return new SmartyManager($app['view.engine.resolver'], $app['view.finder'], $app['events'], new \Smarty);
		    });

		// add smarty extension
		$app['view']->addExtension($app['config']->get('smarty::extension', 'tpl'), 'smarty', function() use ($app){
                return $app->make('Illuminate\View\Engines\EngineInterface', ['smarty' => $app['view']->getSmarty()]);
		    });
	}

    /**
     * register artisan command
     */
    public function registerCommands()
    {
        // Info command
        $this->app['command.smarty.info'] = $this->app->share(function ($app) {
                return new Console\InfoCommand;
            });
        $this->commands('command.smarty.info');

        // cache clear
        $this->app['command.smarty.cache.clear'] = $this->app->share(function ($app) {
                return new Console\CacheClearCommand($this->app['view']->getSmarty());
            });
        $this->commands('command.smarty.cache.clear');

        // clear compiled
        $this->app['command.smarty.clear.compiled'] = $this->app->share(function ($app) {
                return new Console\CompiledClearCommand($this->app['view']->getSmarty());
            });
        $this->commands('command.smarty.clear.compiled');
    }
}