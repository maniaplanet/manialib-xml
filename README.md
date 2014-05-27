ManiaLib\XML
===================================================

[![Latest Stable Version](https://poser.pugx.org/maniaplanet/manialib-xml/v/stable.png)](https://packagist.org/packages/maniaplanet/manialib-xml)
[![Development Version](https://poser.pugx.org/maniaplanet/manialib-xml/v/unstable.png)](https://packagist.org/packages/maniaplanet/manialib-xml)
[![Total Downloads](https://poser.pugx.org/maniaplanet/manialib-xml/downloads.png)](https://packagist.org/packages/maniaplanet/manialib-xml)

ManiaLib\XML is an object-oriented PHP library for writing XML.

Installation
-----------------------------

[Install via Composer](https://getcomposer.org/):

```
{
	"require": {
        "maniaplanet/manialib-xml": "~0.2"
    }
}
```

Features
-----------------------------
 * Simple and flexible object-oriented architecture
 * Configurable rendering drivers
 * Symfony\Component\EventDispatcher integration
 
Architecture
-----------------------------

 * You construct a tree of `ManiaLib\XML\Node`.
 * Setter methods return the element for chaining (eg. `$node->setNodeName('foo')->setNodeValue('bar');`.
 * `ManiaLib\XML\Node::create()` instanciates the object and returns it for easy chaining (eg. `Node::create()->setNodeName('foo');`).
 * If you're running PHP 5.4+ you can use class member access on instantiation instead eg. 
`(new Node)->setNodeName('foo');`.
 * See `ManiaLib\XML\NodeInterface` for reference.
 * You then pass the root `Node` to an instance of `ManiaLib\XML\Rendering\Renderer`.

Examples
-----------------------------

```
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
```

It will output:
```
<rootElement rootAttrivute="1.0">
    <someElement someAttribute="foo" otherAttribute="bar">
        Hello world
    </someElement>
    <anotherOne/>
</rootElement>
```

More in /examples directory

Todo
-----------------------------
 * XMLComment
 * PhpDoc
 


