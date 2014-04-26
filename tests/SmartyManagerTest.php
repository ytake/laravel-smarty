<?php

use Mockery as m;
use Comnect\Smarty\SmartyManager;

class SmartyManagerTest extends PHPUnit_Framework_TestCase
{
    /** @var \Comnect\Smarty\SmartyManager */
    protected $manager;

    public function __construct()
    {
        m::close();
    }

    public function setUp()
    {
        $tmpConfig = include 'config.php';
        $app = m::mock('AppMock');
        $app->shouldReceive('instance')->once()->andReturn($app);

        Illuminate\Support\Facades\Facade::setFacadeApplication($app);
        Illuminate\Support\Facades\Config::swap($config = m::mock('ConfigMock'));

        foreach($tmpConfig as $key => $row)
        {
            $config->shouldReceive('get')->once()->with("smarty::{$key}")->andReturn($row);
        }
        $this->manager = new SmartyManager(
            m::mock('Illuminate\View\Engines\EngineResolver'),
            m::mock('Illuminate\View\ViewFinderInterface'),
            m::mock('Illuminate\Events\Dispatcher'),
            new \Smarty()
        );
    }

    public function testComnectSmartyVersion()
    {
        $this->assertSame('0.3', $this->manager->getVersion());
    }

    public function testGetSmarty()
    {
        $this->assertInstanceOf('Smarty', $this->manager->getSmarty());
    }

    public function testCallSmartyFunction()
    {
        $this->manager->assign('value', 'hello');
        $this->assertSame('hello', $this->manager->getTemplateVars('value'));
        $this->assertSame('hellohello', $this->manager->fetch(realpath(null) . '/tests/views/test.tpl'));
        $this->manager->clearAllAssign();
        $this->assertSame('hello', $this->manager->fetch(realpath(null) . '/tests/views/test.tpl'));
        $this->assertSame(null, $this->manager->getTemplateVars('value'));
    }

    /**
     * @expectedException ReflectionException
     */
    public function testUndefinedFunction()
    {
        $this->manager->hello();
        $this->manager->assing();
        $this->manager->smarty([1 => 2]);
    }

    public function testPlugins()
    {
        $this->manager->assign('value', 'hello');
        $this->assertSame('test', $this->manager->fetch(realpath(null) . '/tests/views/plugin_test.tpl'));
    }

    public function testClearFile()
    {
        $this->manager->clearCompiledTemplate();
        $this->assertSame(0, count($this->scan()));
    }

    public function scan()
    {
        $files = [];
        $dir = opendir(realpath(null) . '/tests/views/storage/smarty/compile');
        while($file = readdir($dir))
        {
            if($file != '.' && $file != '..' && $file != '.gitkeep')
            {
                $files[] = $file;
            }
        }
        closedir($dir);
        return $files;
    }
}