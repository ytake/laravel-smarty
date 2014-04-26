<?php
namespace Comnect\Smarty\Engines;

use Smarty;
use Illuminate\View;
use Illuminate\View\Engines;
use Illuminate\View\Engines\EngineInterface;

/**
 * Class SmartyEngine
 * @package Comnect\Smarty\Engines
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @license MIT
 */
class SmartyEngine implements EngineInterface
{
    /** @var Smarty */
    protected $smarty;

	/**
	 * @param Smarty $smarty
	 */
	public function __construct(Smarty $smarty)
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