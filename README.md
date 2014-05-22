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
        "maniaplanet/manialib-xml": "dev-event-dispatcher"
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

 * You construct a tree of `ManiaLib\XML\NodeInterface`.
 * `ManiaLib\XML\Node` is the default implementation of `ManiaLib\XML\NodeInterface`.
 * Setter methods return the element for chaining (eg. `$node->setNodeName('foo')->setNodeValue('bar');`.
 * `ManiaLib\XML\Node::create()` instanciates the object and returns it for easy chaining (eg. `Node::create()->setNodeName('foo');`).
 * If you're running PHP 5.4+ you can use class member access on instantiation instead eg. 
`(new Node)->setNodeName('foo');`.
 * See `ManiaLib\XML\NodeInterface` for reference.
 * Rendering is done by an implementation of `ManiaLib\XML\Rendering\RendererInterface`.
 * `ManiaLib\XML\Rendering\Renderer` is the default implementation of `ManiaLib\XML\Rendering\RendererInterface`.
 * `ManiaLib\XML\Rendering\RendererInterface` needs an implementation of `ManiaLib\XML\Rendering\DriverInterface`.
 * `ManiaLib\XML\Rendering\Drivers\XMLWriterDriver` is the default implementation of `ManiaLib\XML\Rendering\DriverInterface`.

Examples
-----------------------------

See /examples directory

Todo
-----------------------------
 * XMLComment
 * PhpDoc
 


