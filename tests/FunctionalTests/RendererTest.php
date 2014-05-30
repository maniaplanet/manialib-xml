<?php
namespace FunctionalTests;

use ManiaLib\XML\NodeInterface;
use ManiaLib\XML\Rendering\DriverInterface;
use ManiaLib\XML\Rendering\Renderer;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Finder\Finder;

class RendererTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var Renderer
	 */
	protected $renderer;

	protected function setUp()
	{
		$this->renderer = new Renderer();
	}

	public function nodeAndDriverProvider()
	{
		if(!defined('PATH_TO_EXAMPLES'))
		{
			define('PATH_TO_EXAMPLES', '../../examples/');
		}
		$examplesFinder = new Finder();
		if(substr(PATH_TO_EXAMPLES, 0, 1) == '/')
		{
			$examplesFinder->in(PATH_TO_EXAMPLES);
		}
		else
		{
			$examplesFinder->in(__DIR__.DIRECTORY_SEPARATOR.PATH_TO_EXAMPLES);
		}
		$examplesFinder->files()->name('*.php');

		$driversFinder = new Finder();
		$driversFinder->in(__DIR__.'/../../src/ManiaLib/XML/Rendering/Drivers/')->files()->name('*.php');

		$tests = array();
		foreach($examplesFinder as $file)
		{
			foreach($driversFinder as $driverFile)
			{
				$node = require $file->getRealPath();
				$expect = $file->getPath().'/'.$file->getBasename($file->getExtension()).'xml';
				$classname = '\ManiaLib\XML\Rendering\Drivers\\'.$driverFile->getBasename('.'.$file->getExtension());
				$driver = new $classname();
				$tests[] = array($node, $driver, $expect);
			}
		}

		return $tests;
	}

	/**
	 * @dataProvider nodeAndDriverProvider
	 */
	public function testRendering(NodeInterface $node, DriverInterface $driver, $expectedResult)
	{
		$this->renderer->setRoot($node);
		$driver->setEventDispatcher($this->renderer->getEventDispatcher());
		$this->renderer->setDriver($driver);
		$this->assertXmlStringEqualsXmlFile($expectedResult, $this->renderer->getXML());
	}

}
