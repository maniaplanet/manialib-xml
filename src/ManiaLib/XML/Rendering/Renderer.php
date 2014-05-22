<?php

namespace ManiaLib\XML\Rendering;

use ManiaLib\XML\Exception;
use ManiaLib\XML\Node;
use ManiaLib\XML\Rendering\Drivers\XMLWriterDriver;

class Renderer implements RendererInterface
{

	/**
	 * @var Node
	 */
	protected $root;

	/**
	 * @var DriverInterface
	 */
	protected $driver;
	
	/**
	 * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
	 */
	protected $eventDispatcher;

	function setRoot(Node $node)
	{
		$this->root = $node;
	}

	public function getRoot()
	{
		return $this->root;
	}

	function setDriver(DriverInterface $driver)
	{
		$this->driver = $driver;
	}

	function getDriver()
	{
		if(!$this->driver)
		{
			$driver = new XMLWriterDriver();
			$driver->setEventDispatcher($this->getEventDispatcher());
			$this->setDriver($driver);
		}
		return $this->driver;
	}

	public function setEventDispatcher(\Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher)
	{
		$this->eventDispatcher = $eventDispatcher;
	}
	
	public function getEventDispatcher()
	{
		if(!$this->eventDispatcher)
		{
			$this->setEventDispatcher(new \Symfony\Component\EventDispatcher\EventDispatcher());
		}
		return $this->eventDispatcher;
	}

	function getXML()
	{
		if(!($this->root instanceof Node))
		{
			throw new Exception('No ManiaLib\XML\Node root found.');
		}
		return $this->getDriver()->getXML($this->root);
	}

}
