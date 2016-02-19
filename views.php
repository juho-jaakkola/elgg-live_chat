<?php

$plugin_path = __DIR__;
$elgg_root = dirname(dirname(__DIR__));

$path = file_exists("{$plugin_path}/vendor/") ? $plugin_path : $elgg_root;

return [
	'default' => [
		'mustache.js' => $path . '/vendor/bower-asset/mustache.js/mustache.min.js',
	]
];
