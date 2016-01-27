define(function(require) {
	var $ = require('jquery');
	var pusher = require('pusher');

	var users = {};

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

		var user_guid = $(this).data('guid');
		var name = $(this).text();

		if (user_guid in users) {
			// TODO Move focus to the chat window?
			return;
		}

		// Check whether there is an existing chat with the chosen user
		elgg.action('live_chat/open', {
			//dataType: "json",
			data: {guid: user_guid},
			success: function(json) {
				var chat_guid = json.output.chat_guid;

				users[user_guid] = true;

				$('#elgg-chat-bar').append(
					'<div class="elgg-module elgg-module-featured elgg-module-chat">' +
						'<div class="elgg-head">' + name + '</div>' +
						'<div class="elgg-body">' +
							'<ul class="elgg-chat-' + chat_guid + ' elgg-chat-messages">' + json.output.messages +
								'<input type="text" class="elgg-chat-input data-guid=' + chat_guid + '" />' +
							'</ul>' +
						'</div>' +
					'</div>'
				);

				var chatWindow = $('.elgg-chat-' + chat_guid);

				chatWindow.scrollTop(chatWindow.height());
			}
		});
	});
});
