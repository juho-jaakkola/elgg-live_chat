define(function(require) {
	var $ = require('jquery');
	var pusher = require('pusher');

	pusher.registerConsumer('live_chat', function(data) {
		$('.elgg-chat-messages').append(data.html);
	});

	pusher.registerListener('live_chat', function(data) {
		$.each(data.users, function(key, user_guid) {
			$('#elgg-chat-users #elgg-user-' + user_guid + ' .elgg-body')
				.prepend('<span class="elgg-icon fa fa-circle"></span>');
		});
	});
});
