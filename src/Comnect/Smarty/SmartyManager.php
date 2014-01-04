<?php
namespace Comnect\Smarty;

use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\ViewFinderInterface;
use Illuminate\Events\Dispatcher;
use Illuminate\View\Environment;
use Illuminate\Support\Facades\Config;

/**
 * SmartyManager
 * @author yuuki.takezawa <yuuki.takezawa@comnect.jp.net>
 *
 * @license MIT
 */
class SmartyManager extends Environment
{
	/**
	 * @var string Comnect\Smarty\SmartyManager version
	 */
	const VERSION = '0.1';

	protected $smarty;
	/**
	 * @param EngineResolver $engines
	 * @param ViewFinderInterface $finder
	 * @param Dispatcher $events
	 */
	public function __construct(EngineResolver $engines, ViewFinderInterface $finder, Dispatcher $events, \Smarty $smarty)
	{
		parent::__construct($engines, $finder, $events);

		$this->smarty = $smarty;
		$this->_setSmarty();
	}

	/**
	 * smarty cache clear
	 * @param  integer $expTime expiration time
	 * @param  string  $type     resource type
	 * @return
	 */
	public function clearAllCache($expTime = null, $type = null)
	{
		$this->smarty->clearAllCache($expTime, $type);
	}

	/**
	 * Empty cache for a specific template
	 *
	 * @param  string  $template_name template name
	 * @param  string  $cache_id      cache id
	 * @param  string  $compile_id    compile id
	 * @param  integer $exp_time      expiration time
	 * @param  string  $type          resource type
	 * @return integer number of cache files deleted
	 */
	public function clearCache($template_name, $cache_id = null, $compile_id = null, $exp_time = null, $type = null)
	{
		$this->smarty->clearCache($template_name, $cache_id, $compile_id, $exp_time, $type);
	}

	/**
	 * @return \Smarty
	 */
	public function getSmarty(){

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
	 * smarty var assign
	 * @param $var
	 * @param null $value
	 * @param bool $nocache
	 * @return Smarty_Internal_Data
	 */
	public function assign($var, $value = null, $nocache = false)
	{
		$this->smarty->assign($var, $value, $nocache);
	}

	/**
	 * smarty
	 * @access private
	 * @return void
	 */
	private function _setSmarty()
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
}