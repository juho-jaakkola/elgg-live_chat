define(function(require) {
	var $ = require('jquery');
	var pusher = require('pusher');

	pusher.registerConsumer('live_chat', function(data) {
		$('.elgg-chat-messages').append(data.html);
	});
});
