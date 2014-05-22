<?php

namespace ManiaLib\XML\Rendering;

use ManiaLib\XML\Node;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

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

	function setEventDispatcher(EventDispatcherInterface $eventDispatcher);

	/**
	 * @return EventDispatcherInterface
	 */
	function getEventDispatcher();

	function getXML();
}
