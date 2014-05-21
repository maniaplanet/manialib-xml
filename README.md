ManiaLib\XML
===================================================

ManiaLib\XML is an object-oriented PHP library for generating XML.

Requirements
-----------------------------

 * PHP 5.3+

Installation
-----------------------------

[Install via Composer](https://getcomposer.org/):

```
{
	"require": {
        "maniaplanet/manialib-xml": "~1"
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

Todo
-----------------------------
 * XMLComment
 * Code example
 * Best practices
 * Doc
 

