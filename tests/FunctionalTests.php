<?php
require_once __DIR__.'/../vendor/autoload.php';

class FunctionalTests extends PHPUnit_Framework_TestCase
{
	protected $examplesPath;
	/**
	 * @var \ManiaLib\XML\Rendering\Renderer
	 */
	protected $renderer;

	protected function setUp()
	{
		$this->examplesPath = __DIR__.'/../examples/';
		$this->renderer = new \ManiaLib\XML\Rendering\Renderer();
	}

	public function testBasicUsageDOMDocumentDriver()
	{
		$scriptName = 'basic-usage';
		$root = require $this->examplesPath.$scriptName.'.php';
		$this->renderer->setRoot($root);
		$this->assertXmlStringEqualsXmlFile($this->examplesPath.$scriptName.'.xml', $this->renderer->getXML());
	}
}
