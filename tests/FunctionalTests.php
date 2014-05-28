<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Finder\Finder;

class FunctionalTests extends PHPUnit_Framework_TestCase
{

	protected $examplesPath;

	/**
	 * @var \ManiaLib\XML\Rendering\Renderer
	 */
	protected $renderer;

	protected function setUp()
	{
		$this->renderer = new \ManiaLib\XML\Rendering\Renderer();
	}

	public function nodeAndResultsProvider()
	{
		$finder = new Finder();
		$finder->in(__DIR__.'/../examples/')->files()->name('*.php');
		$tests = array();
		foreach($finder as $file)
		{
			$node = require $file->getRealPath();
			$expect = $file->getPath().'/'.$file->getBasename($file->getExtension()).'xml';
			$tests[] = array($node, $expect);
		}

		return $tests;
	}

	/**
	 * @dataProvider nodeAndResultsProvider
	 */
	public function testBasicUsageDOMDocumentDriver(ManiaLib\XML\NodeInterface $node, $expectedResult)
	{
		$this->renderer->setRoot($node);
		$this->assertXmlStringEqualsXmlFile($expectedResult, $this->renderer->getXML());
	}

	/**
	 * @dataProvider nodeAndResultsProvider
	 */
	public function testBasicUsageXMLWriterDriver(ManiaLib\XML\NodeInterface $node, $expectedResult)
	{
		$driver = new \ManiaLib\XML\Rendering\Drivers\XMLWriterDriver();
		$driver->setEventDispatcher($this->renderer->getEventDispatcher());
		
		$this->renderer->setRoot($node);
		$this->renderer->setDriver($driver);
		$this->assertXmlStringEqualsXmlFile($expectedResult, $this->renderer->getXML());
	}

}
