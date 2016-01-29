
#elgg-chat-bar {
	width: 100%;
	height: 0;
	position: fixed;
	padding-right: 300px;
	right: 0;
	bottom: 0;
}

.elgg-module-chat {
	background: white;
	width: 260px;
	position: relative;
	bottom: 360px;
	margin: 0;
	float: right;
}

.elgg-module-chat .elgg-chat-messages {
	height: 265px;
	overflow: auto;
}

.elgg-module-chat .elgg-image-block {
	padding: 0;
	margin: 6px 0;
}

.elgg-module-chat .elgg-content {
	margin: 0 5px 0 0;
	padding: 5px 10px;
	border: 1px solid #ccc;
	border-radius: 15px;
	font-size: 0.9em;
	line-height: 1.2em;
}

#elgg-chat-users {
	background: white;
	width: 300px;
	position: fixed;
	bottom: 0;
	right: 0;
	margin-bottom: 0;
}

#elgg-chat-users > .elgg-body {
	max-height: 400px;
	overflow: auto;
}

#elgg-chat-users .elgg-icon-circle {
	float: right;
}

#elgg-chat-users .elgg-status-online .elgg-icon-circle {
	color: green;
}
