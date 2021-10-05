<?php

//$hook = "https://api.telegram.org/bot2026548842:AAE52wMvxNWqqFPpA9OnyJKo2YVnBxiYvm0/setWebhook?url=http://telebot.bdsoftcreation.com/index.php"

$input = file_get_contents("php://input");
$data = json_decode($input); 
$chat_id = $data->message->chat->id;
$text = $data->message->text;


$token = "2026548842:AAE52wMvxNWqqFPpA9OnyJKo2YVnBxiYvm0";
$text = "Good morning!";
$chat_id = 2037102579;
$send_msg = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$text";

file_get_contents($send_msg);

