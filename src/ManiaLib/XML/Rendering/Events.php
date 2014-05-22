<?php

namespace ManiaLib\XML\Rendering;

abstract class Events
{

	const ADD_SUBSCRIBER = 'manialib.xml.rendering.add_subscriber';
	
	static public function preCreate(\ManiaLib\XML\NodeInterface $node)
	{
		return 'manialib.xml.rendering.'.spl_object_hash($node).'pre_create';
	}

	static public function postCreate(\ManiaLib\XML\NodeInterface $node)
	{
		return 'manialib.xml.rendering.'.spl_object_hash($node).'post_create';
	}

}
