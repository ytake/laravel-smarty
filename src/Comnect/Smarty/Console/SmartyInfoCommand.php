<?php

namespace Comnect\Smarty\Console;
use Illuminate\Console\Command;
use Comnect\Smarty\SmartyManager;

class SmartyInfoCommand extends Command
{
	/**
	 * The console command name.
	 * @var string
	 */
	protected $name = 'smarty';

	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = 'information about comnect/smarty';

	/**
	 * Execute the console command.
	 * @return void
	 */
	public function fire()
	{
		$this->line('<info>Smarty</info> version <comment>' . \Smarty::SMARTY_VERSION . '</comment>');
		$this->line('<info>comnect/smarty</info> version <comment>' . SmartyManager::VERSION . '</comment>');
	}
}