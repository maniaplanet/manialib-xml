<?php

use ManiaLib\XML\Node;
use ManiaLib\XML\Rendering\Renderer;

require_once 'vendor/autoload.php';

$root = Node::create()
	->setNodeName('rootElement')
	->setAttribute('rootAttrivute', '1.0');

Node::create()
	->setNodeName('someElement')
	->setAttribute('someAttribute', 'foo')
	->setAttribute('otherAttribute', 'bar')
	->setNodeValue('Hello world')
	->appendTo($root);

$root->appendChild(Node::create()->setNodeName('anotherOne'));

$renderer = new Renderer();
$renderer->setRoot($root);

header("Content-type: application/xml; charset=UTF8");
echo $renderer->getXML();
