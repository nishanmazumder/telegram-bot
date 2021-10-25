<?php

// $bot = https://t.me/wiki_bdsoftcr_bot
include_once './token.php';

//Get message info
$input = file_get_contents("php://input");
$data = json_decode($input);
$user_name =  $data->message->from->first_name;
$chat_id = $data->message->chat->id;
$text = $data->message->text;

if ($text == "/start") {
    $msg = "Welcome $user_name! please enter search keyword:";
} else {

    $text = urlencode(ucwords($text));
    $url = "https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro&explaintext&titles=$text";
    $data = file_get_contents($url);
    $data = json_decode($data, true);

    if(isset($data['query']['pages'])){
        foreach ($data['query']['pages'] as $key => $val) {
            //$msg = "<h1>".urlencode($val['title'])."</h1>%0A";
            $msg = urlencode($val['extract']);
        }
    }else{
        $msg = "No data found!";
    }
}

$token = TOKEN_WIKI;
$send_msg = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$msg&parse_mode=HTML";

file_get_contents($send_msg);
