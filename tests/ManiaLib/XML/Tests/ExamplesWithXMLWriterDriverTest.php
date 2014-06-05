<?php

namespace ManiaLib\XML\Tests;


use ManiaLib\XML\NodeInterface;
use ManiaLib\XML\Rendering\DriverInterface;
use ManiaLib\XML\Rendering\Drivers\XMLWriterDriver;
use ManiaLib\XML\Rendering\Renderer;
use PHPUnit_Framework_TestCase;

class ExamplesWithXMLWriterDriverTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var Renderer
	 */
	protected $renderer;

	/**
	 * @var DriverInterface
	 */
	protected $driver;

	protected function setUp()
	{
		$this->renderer = new Renderer();
		$this->driver = new XMLWriterDriver();
		$this->driver->setEventDispatcher($this->renderer->getEventDispatcher());
	}

	public function getNodes()
	{
		return new ExamplesIterator();
	}

	/**
	 * @dataProvider getNodes
	 */
	public function testExamples(NodeInterface $node, $expectedResult)
	{
		$this->renderer->setRoot($node);
		$this->renderer->setDriver($this->driver);
		$this->assertXmlStringEqualsXmlFile($expectedResult, $this->renderer->getXML());
	}

}
