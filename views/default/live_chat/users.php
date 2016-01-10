<?php

if (!elgg_is_logged_in()) {
	return;
}

$friends = elgg_list_entities_from_relationship(array(
	'relationship' => 'friend',
	'relationship_guid' => elgg_get_logged_in_user_guid(),
	'inverse_relationship' => false,
	'type' => 'user',
	'full_view' => false,
));

echo elgg_view_module('featured', elgg_echo('friends'), $friends, array(
	'id' => 'elgg-chat-users',
));
