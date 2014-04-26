<?php
namespace Comnect\Smarty\Console;

use Smarty;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class CacheClearCommand
 * @package Comnect\Smarty\Console
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class CacheClearCommand extends Command
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
	protected $name = 'comnect:smarty-cacheclear';

	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = 'Flush the comnect/smarty cache';

	/**
	 * Execute the console command.
	 * @return void
	 */
	public function fire()
	{
        // clear all cache
        if(is_null($this->option('file')))
        {
            $this->smarty->clearAllCache($this->option('time'));
            $this->info('smarty cache cleared!');
            return;
        }
        $views = $this->smarty->getTemplateDir(0);
        if(!$this->smarty->clearCache($this->option('file'), null, null, $this->option('time')))
        {
            $this->info('specified file not be found');
            return;
        }
        $this->info('specified file was cache cleared!');
        return;
	}

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['file', 'f', InputOption::VALUE_OPTIONAL, 'specify file'],
            ['time', 't', InputOption::VALUE_OPTIONAL, 'clear all of the files that are specified duration time']
        ];
    }
}