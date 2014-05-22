<?php

namespace ManiaLib\XML\Rendering;

abstract class Events
{

	static public function preCreate(\ManiaLib\XML\NodeInterface $node)
	{
		return 'manialib.xml.rendering.'.spl_object_hash($node).'pre_create';
	}

	static public function postCreate(\ManiaLib\XML\NodeInterface $node)
	{
		return 'manialib.xml.rendering.'.spl_object_hash($node).'post_create';
	}

}
