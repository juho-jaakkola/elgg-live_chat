<?php

$user_guid = get_input('guid');

$owner = elgg_get_logged_in_user_entity();

$chats = elgg_get_entities_from_relationship(array(
	'type' => 'object',
	'subtype' => 'chat',
	'relationship' => 'member',
	'relationship_guid' => $user_guid,
	'owner_guid' => $owner->guid,
));

$messages = '';

if (empty($chats)) {
	$chat = new ElggChat();
	$chat->owner_guid = $owner->guid;
	$chat->access_id = ACCESS_LOGGED_IN;
	$chat->title = 'Test';
	$chat->save();

	$chat->addMember($owner->guid);
	$chat->addMember($user_guid);
} else {
	// TODO What to do if there are more than one chat?
	$chat =  $chats[0];

	$messages = elgg_view('live_chat/messages', array(
		'entity' => $chat,
		'user' => $owner,
	));
}

echo json_encode((object) array(
	'chat_guid' => $chat->guid,
	'messages' => $messages,
));
