<?php

namespace ManiaLib\XML\Tests;

use ManiaLib\XML\NodeInterface;
use ManiaLib\XML\Rendering\DriverInterface;
use ManiaLib\XML\Rendering\Drivers\DOMDocumentDriver;
use ManiaLib\XML\Rendering\Renderer;
use PHPUnit_Framework_TestCase;

abstract class AbstractExamplesText extends PHPUnit_Framework_TestCase
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
		$this->driver = $this->getDriver();
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

	protected abstract function getDriver();
}
