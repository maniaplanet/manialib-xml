<?php

namespace ManiaLib\XML\Rendering;

use ManiaLib\XML\Exception;
use ManiaLib\XML\NodeInterface;
use ManiaLib\XML\Rendering\Drivers\XMLWriterDriver;

class Renderer implements RendererInterface
{

    /**
     * @var NodeInterface
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

    function setRoot(NodeInterface $node)
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
        if (!$this->driver) {
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
        if (!$this->eventDispatcher) {
            $this->setEventDispatcher(new \Symfony\Component\EventDispatcher\EventDispatcher());
        }
        return $this->eventDispatcher;
    }

    function getXML()
    {
        if (!($this->root instanceof NodeInterface)) {
            throw new Exception('No ManiaLib\XML\NodeInterface root found.');
        }

        $this->getEventDispatcher()->addSubscriber($this->root);
        $this->getEventDispatcher()->dispatch(Events::ADD_SUBSCRIBERS);

        $this->getEventDispatcher()->dispatch(Events::PRE_RENDER);
        $xml = $this->getDriver()->getXML($this->root);
        $this->getEventDispatcher()->dispatch(Events::POST_RENDER);
        return $xml;
    }

}
