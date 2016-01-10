<?php

$user = elgg_extract('entity', $vars);

$image = elgg_view_entity_icon($user, 'small');

$params = array(
	'entity' => $user,
	'metadata' => elgg_view_icon('circle'),
	'subtitle' => $user->briefdescription,
);

$body = elgg_view('user/elements/summary', $params);

echo elgg_view_image_block($image, $body);