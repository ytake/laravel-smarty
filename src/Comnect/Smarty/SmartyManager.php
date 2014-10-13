<?php
namespace Comnect\Smarty;

use ReflectionClass;
use Illuminate\View\Factory;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Config;
use Illuminate\View\ViewFinderInterface;
use Illuminate\View\Engines\EngineResolver;

/**
 * Class SmartyManager
 * @package Comnect\Smarty
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @license MIT
 */
class SmartyManager extends Factory
{

	const VERSION = '2.0.0';

    /** @var \Smarty  */
	protected $smarty;

    /**
     * @param EngineResolver $engines
     * @param ViewFinderInterface $finder
     * @param Dispatcher $events
     * @param \Smarty $smarty
     */
    public function __construct(
        EngineResolver $engines,
        ViewFinderInterface $finder,
        Dispatcher $events,
        \Smarty $smarty
    ) {
		parent::__construct($engines, $finder, $events);

		$this->smarty = $smarty;
		$this->setConfigure();
	}


	/**
	 * @return \Smarty
	 */
	public function getSmarty()
    {
		return $this->smarty;
	}

	/**
	 * @return string
	 */
	public function getVersion()
	{
		return self::VERSION;
	}

	/**
	 * smarty
	 * @access private
	 * @return void
	 */
	private function setConfigure()
	{
		$this->smarty->left_delimiter = Config::get('smarty::left_delimiter');
		$this->smarty->right_delimiter = Config::get('smarty::right_delimiter');
		$this->smarty->setTemplateDir(Config::get('smarty::template_path'));
		$this->smarty->setCompileDir(Config::get('smarty::compile_path'));
		$this->smarty->setCacheDir(Config::get('smarty::cache_path'));

		//
		foreach(Config::get('smarty::plugins_paths') as $plugins)
		{
			$this->smarty->addPluginsDir($plugins);
		}

		$this->smarty->debugging = Config::get('smarty::debugging');
		$this->smarty->caching = Config::get('smarty::caching');
		$this->smarty->cache_lifetime = Config::get('smarty::cache_lifetime');
		$this->smarty->compile_check = Config::get('smarty::compile_check');
		$this->smarty->force_compile = true;
		$this->smarty->error_reporting = E_ALL &~ E_NOTICE;
	}

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        $reflectionClass = new ReflectionClass($this->smarty);
        if(!$reflectionClass->hasMethod($name)) {
            throw new \Exception("{$name} : Method Not Found");
        }
        return call_user_func_array([$this->smarty, $name], $arguments);
    }
}