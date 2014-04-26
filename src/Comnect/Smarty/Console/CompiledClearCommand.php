<?php
namespace Comnect\Smarty\Console;

use Smarty;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class CompiledClearCommand
 * @package Comnect\Smarty\Console
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class CompiledClearCommand extends Command
{
    /** @var Smarty */
    protected $smarty;

    /**
     * @param Smarty $smarty
     */
    public function __construct(Smarty $smarty)
    {
        parent::__construct();
        $this->smarty = $smarty;
    }

	/**
	 * The console command name.
	 * @var string
	 */
	protected $name = 'comnect:smarty-clear-compiled';

	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = 'Remove the compiled comnect/smarty class file';

	/**
	 * Execute the console command.
	 * @return void
	 */
	public function fire()
	{
        if($this->smarty->clearCompiledTemplate($this->option('file')))
        {
            $this->info('done!');
            return;
        }
        $this->info('compiled file not be found');
        return;
	}

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['file', 'f', InputOption::VALUE_OPTIONAL, 'specify file']
        ];
    }
}