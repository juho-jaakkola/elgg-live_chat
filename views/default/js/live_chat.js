define(function(require) {
	var $ = require('jquery');
	var pusher = require('pusher');

	pusher.registerConsumer('live_chat', function(data) {
		$('.elgg-chat-messages').append(data.html);
	});

	pusher.registerListener('live_chat', function(data) {
		var users = '';

		$.each(data.users, function(key, user_guid) {
			users += "<li>" + user_guid + "</li>";
		});

		$('#elgg-online-users .elgg-body').html("<ul>" + users + "</ul>");
	});
});
