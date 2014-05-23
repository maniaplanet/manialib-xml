<?php

namespace ManiaLib\XML\Rendering;

use ManiaLib\XML\NodeInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

interface DriverInterface
{

    function setEventDispatcher(EventDispatcherInterface $eventDispatcher);

    function getXML(NodeInterface $root);

    function appendXML($xml);
}
