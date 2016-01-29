<?php

$path = file_exists(__DIR__ . '/vendor/') ? __DIR__ : '';

return [
	'default' => [
		'js/mustache.js' => $path . '/vendor/bower-asset/mustache.js/mustache.min.js',
	]
];