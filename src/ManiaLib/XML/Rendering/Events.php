<?php

namespace ManiaLib\XML\Rendering;

use ManiaLib\XML\NodeInterface;

abstract class Events
{

	const ADD_SUBSCRIBERS = 'manialib.xml.rendering.add_subscribers';
	const PRE_RENDER = 'manialib.xml.rendering.pre_render';
	const POST_RENDER = 'manialib.xml.rendering.post_render';

	static public function preCreate(NodeInterface $node)
	{
		return 'manialib.xml.rendering.'.spl_object_hash($node).'.pre_create';
	}

	static public function postCreate(NodeInterface $node)
	{
		return 'manialib.xml.rendering.'.spl_object_hash($node).'.post_create';
	}

}
