<?php 

$url = urlencode('[URL_YOU_WANT_SHORTEN]');
$json = file_get_contents("https://cutt.ly/api/api.php?key=[API_KEY]&short=$url&name=[CUSTOM_URL_ALIAS]");
$data = json_decode ($json, true);
var_dump($data);