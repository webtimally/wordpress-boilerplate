<?php

defined('ABSPATH') || exit;

function block_template_render_callback($attr, $content)
{
	return "This is a render of the template block.";
};