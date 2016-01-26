<?php

if (!elgg_is_logged_in()) {
	return;
}

$friends = elgg_list_entities_from_relationship(array(
	'relationship' => 'friend',
	'relationship_guid' => elgg_get_logged_in_user_guid(),
	'inverse_relationship' => false,
	'type' => 'user',
	'item_view' => 'live_chat/user',
	'full_view' => false,
));

$module = elgg_view_module('featured', elgg_echo('friends'), $friends, array(
	'id' => 'elgg-chat-users',
));

echo <<<HTML
	<div id="elgg-chat-bar">$module</div>
HTML;
