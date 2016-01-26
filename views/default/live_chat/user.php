<?php

$user = elgg_extract('entity', $vars);

$image = elgg_view_entity_icon($user, 'small');

$title = elgg_view('output/url', array(
	'text' => elgg_get_excerpt($user->name, 100),
	'href' => $user->getURL(),
	'is_trusted' => true,
	'data-guid' => $user->guid,
	'class' => 'elgg-chat-user',
));

$params = array(
	'entity' => $user,
	'title' => $title,
	'metadata' => elgg_view_icon('circle'),
	'subtitle' => $user->briefdescription,
);

$body = elgg_view('user/elements/summary', $params);

echo elgg_view_image_block($image, $body);