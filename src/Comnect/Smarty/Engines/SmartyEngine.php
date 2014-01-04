<?php
/**
 * Created by PhpStorm.
 * User: yuuki.takezawa
 * Date: 2014/01/03
 * Time: 2:05
 */
namespace Comnect\Smarty\Engines;

use Illuminate\View;
use Illuminate\View\Engines;
use Illuminate\View\Engines\EngineInterface;
/**
 * SmartyEngine
 * @author yuuki.takezawa <yuuki.takezawa@comnect.jp.net>
 * @package Smarty
 * @license MIT
 */
class SmartyEngine implements EngineInterface{

	/**
	 * @param $smarty
	 */
	public function __construct(\Smarty $smarty)
	{
		$this->smarty = $smarty;
	}

	/**
	 * Get the evaluated contents of the view.
	 * @param  string  $path
	 * @param  array   $data
	 * @return string
	 */
	public function get($path, array $data = array())
	{
		return $this->evaluatePath($path, $data);
	}

	/**
	 * Get the evaluated contents of the view at the given path.
	 *
	 * @param string $path
	 * @param array $data
	 * @return string
	 */
	protected function evaluatePath($path, array $data = array())
	{
		ob_start();
		try {

			//
			foreach ($data as $var => $val)
			{
				$this->smarty->assign($var, $val);
			}

			// render
			$this->smarty->display($path);

		} catch (\Exception $e) {
			$this->handleViewException($e);
		}

		return ob_get_clean();
	}

	/**
	 * Handle a view exception.
	 *
	 * @param Exception $e
	 * @return void
	 */
	protected function handleViewException($e)
	{
		ob_get_clean(); throw $e;
	}


}