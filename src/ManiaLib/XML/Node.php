<?php

namespace ManiaLib\XML;

class Node implements NodeInterface
{

	/**
	 * @var string
	 */
	protected $nodeName;

	/**
	 * @var string
	 */
	protected $nodeValue;

	/**
	 * @var mixed[]
	 */
	protected $attributes = array();

	/**
	 * @var Node[]
	 */
	protected $children = array();

	/**
	 * @var Node
	 */
	protected $parent;

	/**
	 * @var Node
	 */
	protected $current;

	/**
	 * @var callable[][]
	 */
	protected $callbacks = array();

	public static function create()
	{
		return new static;
	}
	
	public static function getSubscribedEvents()
	{
		return array();
	}

	function __construct()
	{
		$this->current = $this;
	}

	function __clone()
	{
		$this->deleteParent();

		foreach($this->children as $key => $child)
		{
			$cloned = clone $child;
			foreach($this as $propertyName => $propertyValue)
			{
				if($child === $propertyValue)
				{
					$this->$propertyName = $cloned;
				}
			}
			$this->removeChild($child);
			$this->appendChild($cloned);
		}

		foreach($this->callbacks as $id => $callbacks)
		{
			foreach($callbacks as $key => $callback)
			{
				if(is_array($callback) && count($callback) == 2)
				{
					list($object, $method) = $callback;
					if($object == $this->current)
					{
						// There may be some weird edge cases, but this should cover most of the cloning issues.
						$this->callbacks[$id][$key] = array($this, $method);
					}
				}
			}
		}

		$this->current = $this;
	}

	function getClone()
	{
		return clone $this;
	}

	function setNodeName($nodeName)
	{
		$this->nodeName = $nodeName;
		return $this;
	}

	function getNodeName()
	{
		return $this->nodeName;
	}

	function setNodeValue($value)
	{
		$this->nodeValue = $value;
		return $this;
	}

	function appendNodeValue($value)
	{
		$this->nodeValue .= $value;
		return $this;
	}

	function getNodeValue()
	{
		return $this->nodeValue;
	}

	function setAttribute($name, $value)
	{
		$this->attributes[$name] = $value;
		return $this;
	}

	function appendAttribute($name, $value)
	{
		$this->attributes[$name] .= $value;
		return $this;
	}

	function attributeExists($name)
	{
		return array_key_exists($name, $this->attributes);
	}

	function getAttribute($name, $default = null)
	{
		return $this->attributeExists($name) ? $this->attributes[$name] : $default;
	}

	function getAttributes()
	{
		return $this->attributes;
	}

	/**
	 * @return \static
	 */
	function deleteAttribute($name)
	{
		unset($this->attributes[$name]);
		return $this;
	}

	function setParent(NodeInterface $node)
	{
		$this->parent = $node;
		return $this;
	}

	function deleteParent()
	{
		$this->parent = null;
		return $this;
	}

	function getParent()
	{
		return $this->parent;
	}

	function getChildren()
	{
		return $this->children;
	}

	function appendChild(NodeInterface $child)
	{
		if($child->getParent() instanceof Node)
		{
			throw new Exception('Cannot append a child: it already has a parent Node.');
		}
		$this->children[] = $child;
		$child->setParent($this);
		return $this;
	}

	function appendTo(NodeInterface $parent)
	{
		$parent->appendChild($this);
		return $this;
	}
	
	function removeChild(NodeInterface $child)
	{
		$key = array_search($child, $this->children);
		if($key === false)
		{
			throw new Exception('Cannot remove a child: it does not exist.');
		}
		$this->children[$key]->deleteParent();
		unset($this->children[$key]);
		return $this;
	}
}
