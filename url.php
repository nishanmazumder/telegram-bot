<?php

// 21411586289ddcb60bc1e9bc780200c1863bd

$alias = "nmbdsoftcr";
$url = urlencode('');
$json = file_get_contents("https://cutt.ly/api/api.php?key=[API_KEY]&short=$url&name=$alias");
$data = json_decode ($json, true);
var_dump($data);