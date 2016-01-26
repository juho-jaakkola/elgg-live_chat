define(function(require) {
	var $ = require('jquery');
	var pusher = require('pusher');

	var windows = {};

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

	$(document).on('click', '.elgg-chat-user', function(e) {
		e.preventDefault();

		var guid = $(this).data('guid');
		var name = $(this).text();

		if (guid in windows) {
			// TODO Move focus to the chat window?
			return;
		}

		windows[guid] = true;

		$('#elgg-chat-bar').append(
			'<div class="elgg-module elgg-module-featured">' +
				'<div class="elgg-head">' + name + '</div>' +
				'<div class="elgg-body">This feature does not work yet. Try again later.</div>' +
			'</div>'
		);
	});
});
