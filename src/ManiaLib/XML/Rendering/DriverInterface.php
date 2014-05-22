<?php

namespace ManiaLib\XML\Rendering;

use ManiaLib\XML\Node;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

interface DriverInterface
{

	function setEventDispatcher(EventDispatcherInterface $eventDispatcher);

	function getXML(Node $root);

	function appendXML($xml);
}
