<?php
/**
 * Live chat
 */

elgg_register_event_handler('init', 'system', function() {
	elgg_require_js('live_chat');

	elgg_extend_view('page/elements/body', 'live_chat/bar');
	elgg_extend_view('elgg.css', 'live_chat/css');

	elgg_register_action('live_chat/open', __DIR__ . '/actions/live_chat/open.php');
});

elgg_register_event_handler('create', 'object', function($event, $type, $object) {
	if (!elgg_instanceof($object, 'object', 'chat_message')) {
		return;
	}

	$context = new ZMQContext();
	$socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
	$socket->connect("tcp://localhost:5555");

	$msg = new \stdClass();
	$msg->consumer = 'live_chat';
	$msg->html = elgg_view_entity($object);

	$chat = $object->getContainerEntity();

	foreach ($chat->getMemberGuids() as $user_guid) {
		$msg->recipient_guid = $user_guid;
		$socket->send(json_encode($msg));
	}
});
