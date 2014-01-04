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
		// smarty register
		$this->registerSmartyEngine();
		// register command
		$this->registerCommands();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['config']->package('comnect/smarty', __DIR__.'/../config');
	}

	/**
	 * register smarty engine
	 * @return Engines\SmartyEngine
	 */
	public function registerSmartyEngine()
	{
		$app = $this->app;
		// share
		$app['view'] = $app->share(
			function ($app) {
				return new SmartyManager($app['view.engine.resolver'], $app['view.finder'], $app['events'], new \Smarty);
			}
		);

		// add smarty extension
		$app['view']->addExtension($app['config']->get('smarty::extension', 'tpl'), 'smarty', function() use ($app){

			return new Engines\SmartyEngine($app['view']->getSmarty());
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

	public function registerCommands()
	{
		// Info command
		$this->app['command.smarty'] = $this->app->share(
			function ($app) {
				return new Console\SmartyInfoCommand;
			}
		);
		$this->commands(
			'command.smarty'
		);
	}
}