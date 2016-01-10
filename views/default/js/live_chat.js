define(function(require) {
	var $ = require('jquery');
	var pusher = require('pusher');

	pusher.registerConsumer('live_chat', function(data) {
		$('.elgg-chat-messages').append(data.html);
	});

	pusher.registerListener('live_chat', function(data) {
		// First mark all users as offline
		$('#elgg-chat-users .elgg-item-user').removeClass('elgg-status-online');

		// Then mark online status only for the users who are actually online
		$.each(data.users, function(key, user_guid) {
			$('#elgg-chat-users #elgg-user-' + user_guid).addClass('elgg-status-online');
		});
	});
});
