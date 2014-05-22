<?php

namespace ManiaLib\XML\Rendering;

use ManiaLib\XML\Exception;
use ManiaLib\XML\Node;

class Renderer
{

	/**
	 * @var Node
	 */
	protected $root;

	/**
	 * @var DriverInterface
	 */
	protected $driver;

	function setRoot(Node $node)
	{
		$this->root = $node;
	}

	function setDriver(DriverInterface $driver)
	{
		$this->driver = $driver;
	}

	/**
	 * @return DriverInterface
	 */
	function getDriver()
	{
		if(!$this->driver)
		{
			$this->setDriver(new Drivers\XMLWriterDriver());
		}
		return $this->driver;
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
