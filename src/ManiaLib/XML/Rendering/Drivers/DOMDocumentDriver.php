<?php

namespace ManiaLib\XML\Rendering\Drivers;

use DOMDocument;
use ManiaLib\XML\Fragment;
use ManiaLib\XML\NodeInterface;
use ManiaLib\XML\Rendering\DriverInterface;
use ManiaLib\XML\Rendering\Events;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DOMDocumentDriver implements DriverInterface
{

	/**
	 * @var DOMDocument
	 */
	protected $document;
	
	/**
	 * @var EventDispatcherInterface 
	 */
	protected $eventDispatcher;

	function __construct()
	{
		$this->document = new DOMDocument('1.0', 'UTF-8');
	}
	
	public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
	{
		$this->eventDispatcher = $eventDispatcher;
	}

	function getXML(NodeInterface $root)
	{
		$this->eventDispatcher->dispatch(Events::PRE_RENDER);
		$this->document->appendChild($this->getElement($root));
		$xml = $this->document->saveXML();
		$this->eventDispatcher->dispatch(Events::POST_RENDER);
		return $xml;
	}

	function appendXML($xml)
	{
		$fragment = $this->document->createDocumentFragment();
		$fragment->appendXML($xml);
		return $fragment;
	}

	protected function getElement(NodeInterface $node)
	{
		$this->eventDispatcher->addSubscriber($node);
		$this->eventDispatcher->dispatch(Events::ADD_SUBSCRIBER);
		$this->eventDispatcher->dispatch(Events::preCreate($node));

		// XML fragment?
		if($node instanceof Fragment)
		{
			return $this->appendXML($node->getNodeValue());
		}

		// Create
		$element = $this->document->createElement($node->getNodeName());

		// Value
		if($node->getNodeValue() !== null)
		{
			$element->appendChild($this->document->createTextNode($node->getNodeValue()));
		}

		// Attributes
		foreach($node->getAttributes() as $name => $value)
		{
			$element->setAttribute($name, $value);
		}

		// Children
		foreach($node->getChildren() as $child)
		{
			$subelement = $this->getElement($child);
			$element->appendChild($subelement);
		}

		$this->eventDispatcher->dispatch(Events::postCreate($node));

		return $element;
	}

}
