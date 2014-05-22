ManiaLib\XML
===================================================

[![Latest Stable Version](https://poser.pugx.org/maniaplanet/manialib-xml/v/stable.png)](https://packagist.org/packages/maniaplanet/manialib-xml)
[![Total Downloads](https://poser.pugx.org/maniaplanet/manialib-xml/downloads.png)](https://packagist.org/packages/maniaplanet/manialib-xml)

ManiaLib\XML is an object-oriented PHP library for writing XML.

Requirements
-----------------------------

 * PHP 5.3.3+

Installation
-----------------------------

[Install via Composer](https://getcomposer.org/):

```
{
	"require": {
        "maniaplanet/manialib-xml": "~0.1"
    }
}
```

Features
-----------------------------
 * Simple and flexible object-oriented architecture
 * Configurable rendering drivers (DOMDocument or XMLWriter based drivers included)
 
Architecture
-----------------------------

 * You construct a tree of `ManiaLib\XML\Node`.
 * Setter methods return the element for chaining
 * `ManiaLib\XML\Node::create()` instanciates the object and returns it for easy chaining. 
If you're running PHP 5.4+ you can use class member access on instantiation instead eg. 
`(new Node)->setAttribute('foo', 'bar')`.
 * The important methods of Node are:

```
namespace ManiaLib\Manialink;

abstract class Node
{
	function setNodeName($nodeName)
	function setNodeValue($value)
	function setAttribute($name, $value)
	function appendChild(Node $child)
	function appendTo(Node $parent)
}
```
 * Actual XML rendering is done by an implementation of `ManiaLib\XML\Rendering\RendererInterface` (see examples for usage).

Example
-----------------------------

```
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
echo $renderer->getXML();
```

It will output:

```
<?xml version="1.0" encoding="UTF-8"?>
<rootElement rootAttrivute="1.0">
	<someElement someAttribute="foo" otherAttribute="bar">
		Hello world
	</someElement>
	<anotherOne/>
</rootElement>
```

Todo
-----------------------------
 * XMLComment
 * PhpDoc
 


