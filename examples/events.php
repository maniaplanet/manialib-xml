<?php

use ManiaLib\XML\Node;
use ManiaLib\XML\Rendering\Events;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

require_once '../vendor/autoload.php';

class MyCustomNode extends Node
{
	function __construct()
	{
		$this->setNodeName('MyCustomNode');
	}

	protected function registerListeners(EventDispatcherInterface $dispatcher)
	{
		$dispatcher->addListener(Events::preCreate($this), array($this, 'preCreateFoobar'));
	}

	function preCreateFoobar()
	{
		$this->setAttribute('foo', 'bar');
	}

}

$root = new MyCustomNode();

$renderer = new \ManiaLib\XML\Rendering\Renderer();
$renderer->setRoot($root);
	
header("Content-type: application/xml; charset=UTF8");
echo $renderer->getXML();
