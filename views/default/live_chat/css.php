
#elgg-chat-bar {
	width: 100%;
	height: 0;
	position: fixed;
	padding-right: 302px;
	right: 0;
	bottom: 0;
}

.elgg-module-chat > .elgg-head {
	background-color: #F0F0F0;
	padding: 5px 10px;
	height: auto;
	overflow: hidden;
	border-bottom: 1px solid #DCDCDC;
	box-shadow: inset 0 0 1px #FFFFFF;
}

.elgg-module-chat {
	background: white;
	width: 260px;
	position: relative;
	bottom: 345px;
	margin: 0;
	float: right;
	border: 1px solid #DCDCDC;
	border-radius: 3px;
}

.elgg-module-chat .elgg-chat-messages {
	height: 260px;
	padding: 5px 10px;
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

#elgg-chat-users .elgg-image-block {
	padding: 4px 0;
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

.elgg-chat-input {
	border-top: 1px solid #ccc;
	padding: 4px;
}
