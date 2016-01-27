<?php

$chat = elgg_extract('entity', $vars);
$user = elgg_extract('user', $vars);

/**
 * Get messages ascending to get latest messages and then reverse
 * them to make the order chronological (latest messages at bottom).
 */
$messages = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'chat_message',
	'container_guid' => $chat->guid,
	'limit' => 6,
	'order_by' => 'e.time_created desc',
	'pagination' => false,
));
$messages = array_reverse($messages);

$list = '';
foreach ($messages as $message) {
	$is_owner = ($message->owner_guid == $user->guid);

	$message = elgg_view('page/components/image_block', array(
		'image' => $is_owner ? '' : elgg_view_entity_icon($message->getOwnerEntity(), 'tiny', array(
			'use_hover' => false
		)),
		'body' => elgg_view('output/longtext', array(
			'value' => $message->description,
			'class' => $is_owner ? 'float-alt' : 'float',
		))
	));

	$list .= "<li>$message</li>";
}

echo $list;