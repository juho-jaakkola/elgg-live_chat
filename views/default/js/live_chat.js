define(function(require) {
	var $ = require('jquery');
	var pusher = require('pusher');
	var mustache = require('mustache');
	var messageTemplate = require('text!live_chat/message.html');
	var moduleTemplate = require('text!live_chat/module.html');

	var users = {};

	pusher.registerConsumer('live_chat', function(data) {
		var chatId = '.elgg-chat-' + data.message.container_guid;

		var message = mustache.render(messageTemplate, {
			user_url: data.message.url,
			icon_url: data.message.icon_url,
			name: data.message.name,
			message: data.message.message
		});

		if (!$(chatId).length) {
			var view = mustache.render(moduleTemplate, {
				name: 'Test',
				chat_guid: data.message.container_guid
			});

			$('#elgg-chat-bar').append(view);
		}

		$(chatId).append(message);
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

				var messages = '';
				$(json.output.messages).each(function(key, message) {
					messages += mustache.render(messageTemplate, message);
				});

				var view = mustache.render(moduleTemplate, {
					name: 'Test',
					messages: messages,
					chat_guid: chat_guid
				});

				$('#elgg-chat-bar').append(view);

				var chatWindow = $('.elgg-chat-' + chat_guid);

				chatWindow.scrollTop(chatWindow.height());
			}
		});
	});

	$(document).on('submit', '.elgg-chat-input', function(e) {
		e.preventDefault();

		var chat_guid = $(this).data('guid');
		var input = $(this).find('input');
		var message = input.val();

		elgg.action('chat/message/save', {
			data: {
				container_guid: chat_guid,
				message: message,
			}, success: function(json) {
				input.val('');
			}
		});
	});
});
