<?php
/**
 * Live chat
 */

elgg_register_event_handler('init', 'system', function() {
	elgg_require_js('live_chat');

	elgg_extend_view('page/elements/body', 'live_chat/bar');
	elgg_extend_view('elgg.css', 'live_chat/css');

	elgg_register_action('live_chat/open', __DIR__ . '/actions/live_chat/open.php');

	elgg_register_simplecache_view('live_chat/message.html');
});

elgg_register_event_handler('create', 'object', function($event, $type, $object) {
	if (!elgg_instanceof($object, 'object', 'chat_message')) {
		return;
	}

	$context = new ZMQContext();
	$socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
	$socket->connect("tcp://localhost:5555");

	$chat = $object->getContainerEntity();
	$owner = $object->getOwnerEntity();

	$msg = new \stdClass();
	$msg->consumer = 'live_chat';
	$msg->message = (object) array(
		'message' => $object->description,
		'container_guid' => $object->container_guid,
		'owner_guid' => $object->owner_guid,
		'name' => $owner->name,
		'url' => $owner->getURL(),
		'icon_url' => $owner->getIconURL('tiny'),
	);

	foreach ($chat->getMemberGuids() as $user_guid) {
		$msg->recipient_guid = $user_guid;
		$socket->send(json_encode($msg));
	}
});

/**
 * Allow user to create a new chat instance using site as its owner.
 *
 * This allows adding chats that are not owned by any specific user
 * therefore making all participants equal.
 *
 * @param string  $hook   'container_permissions_check'
 * @param string  $type   'object'
 * @param boolean $return Is the user allowed to create the object inside the container?
 * @param array   $params Array containing user, container, entity type and subtype
 */
elgg_register_plugin_hook_handler('container_permissions_check', 'object', function($hook, $type, $return, $params) {
	$container = $params['container'];
	$subtype = $params['subtype'];

	if ($container instanceof ElggSite && $subtype === 'chat') {
		$return = true;
	}

	return $return;
});
