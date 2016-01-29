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
	$message = elgg_view('page/components/image_block', array(
		'image' => elgg_view_entity_icon($message->getOwnerEntity(), 'tiny'),
		'body' => "<div class=\"elgg-content\">{$message->description}</div>",
	));

	$list .= "<li>$message</li>";
}

echo $list;