<?php
// $bot = https://t.me/bdsofcr_bot

include_once './token.php';

$input = file_get_contents("php://input");
$data = json_decode($input);
$user_name =  $data->message->from->first_name;
$chat_id = $data->message->chat->id;
$text = $data->message->text;

if (filter_var($text, FILTER_VALIDATE_URL) === false) {
    $msg = "Welcome $user_name! please enter your url";
} else {
    $api_key = SHORTLINK_API;
    $rand_alis = str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ");
    $alias = substr($rand_alis, 0, 4);
    $url = urlencode($text);
    $json = file_get_contents("https://cutt.ly/api/api.php?key=$api_key&short=$url&name=$alias");
    $data = json_decode($json, true);

    if (isset($data['url']['status'])) {

        $error_msg = [
            "",
            "the shortened link comes from the domain that shortens the link, i.e. the link has already been shortened",
            "the entered link is not a link",
            "the preferred link name is already taken",
            "Invalid API key",
            "the link has not passed the validation. Includes invalid characters",
            "The link provided is from a blocked domain",
            "OK - the link has been shortened"
        ];

        if ($data['url']['status'] == 7) {
            $msg = "Your Short Link: %0A" . $data['url']['shortLink'];
        } else {
            $msg = $error_msg[$data['url']['status']];
        }
    }
}

$send_msg = "https://api.telegram.org/bot" . TOKEN_SHORTLINK . "/sendMessage?chat_id=$chat_id&text=$msg&parse_mode=HTML";

file_get_contents($send_msg);
