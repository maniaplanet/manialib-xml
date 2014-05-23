<?php

namespace ManiaLib\XML\Rendering;

use ManiaLib\XML\NodeInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

interface RendererInterface
{

    function setRoot(NodeInterface $node);

    /**
     * @return NodeInterface
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
