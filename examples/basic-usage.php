<?php

use ManiaLib\XML\Node;
use ManiaLib\XML\Rendering\Renderer;

require_once '../vendor/autoload.php';

// Let's build a Node tree. Here is the root element.
$root = Node::create()
	->setNodeName('rootElement')
	->setAttribute('rootAttrivute', '1.0');

// This is one way to append child, ie. "append this element to its parent"
Node::create()
	->setNodeName('someElement')
	->setAttribute('someAttribute', 'foo')
	->setAttribute('otherAttribute', 'bar')
	->setNodeValue('Hello world')
	->appendTo($root);

// This is another way, ie. "appends a child to this element"
$node = Node::create()->setNodeName('anotherOne');
$root->appendChild($node);

// Let's render the tree
$renderer = new Renderer();
$renderer->setRoot($root);
echo $renderer->getXML();

// It will output
//<rootElement rootAttrivute="1.0"><someElement someAttribute="foo" otherAttribute="bar">Hello world</someElement><anotherOne/></rootElement>
