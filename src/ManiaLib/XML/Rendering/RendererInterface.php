<?php

namespace ManiaLib\XML\Rendering;

use ManiaLib\XML\Node;

interface RendererInterface
{

	function setRoot(Node $node);

	/**
	 * @return Node
	 */
	function getRoot();

	function setDriver(DriverInterface $driver);

	/**
	 * @return DriverInterface
	 */
	function getDriver();
	
	function getXML();
}
