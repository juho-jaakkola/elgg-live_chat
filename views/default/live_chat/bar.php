<?php

if (!elgg_is_logged_in()) {
	return;
}

$dbprefix = elgg_get_config('dbprefix');
$friends = elgg_list_entities_from_relationship(array(
	'relationship' => 'friend',
	'relationship_guid' => elgg_get_logged_in_user_guid(),
	'inverse_relationship' => false,
	'type' => 'user',
	'item_view' => 'live_chat/user',
	'full_view' => false,
	'joins' => array("JOIN {$dbprefix}users_entity ue ON e.guid = ue.guid"),
	'order_by' => 'ue.name ASC',
	'no_results' => elgg_echo('friends:none'),
	'wheres' => array('banned = "no"'),
	'pagination' => false,
	'limit' => false,
));

$module = elgg_view_module('featured', elgg_echo('friends'), $friends, array(
	'id' => 'elgg-chat-users',
));

echo <<<HTML
	$module
	<div id="elgg-chat-bar"></div>
HTML;
