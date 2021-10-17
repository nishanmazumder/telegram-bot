<?php

include_once './db.php';
$db = new Connect;

// $bot = https://t.me/bdsoftcr_candidate_marks_bot
// $token = 2032409974:AAHNbmvr8Hre1TRvBrQ6xVADjM3oHrz1cIA

// Set Web hook info
// https://api.telegram.org/bot2026548842:AAE52wMvxNWqqFPpA9OnyJKo2YVnBxiYvm0/setWebhook?url=https://telebot.bdsoftcreation.com/index.php

// Get Web Hool info
// https://api.telegram.org/bot2026548842:AAE52wMvxNWqqFPpA9OnyJKo2YVnBxiYvm0/getWebhookInfo

// Delete Webhook info
// https://api.telegram.org/bot2026548842:AAE52wMvxNWqqFPpA9OnyJKo2YVnBxiYvm0/deleteWebhook

//Get message info
$input = file_get_contents("php://input");
$data = json_decode($input);
$user_name =  $data->message->from->first_name;
$chat_id = $data->message->chat->id;
$text = $data->message->text;

if ($text == "/start") {
    $msg = "Welcome $user_name! please enter your roll number:";
} else {
    $text = mysqli_real_escape_string($db->con, $text);

    $query = "SELECT * FROM user WHERE user_roll = $text";
    $result = mysqli_query($db->con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name =  $row['user_name'];

        $query = "SELECT * FROM data WHERE user_roll = $text";
        $result = mysqli_query($db->con, $query);

        $marks = "";
        $total = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $marks .= $row['subject'] . " : " . $row['mark'] ."%". "%0A";
            $total = $total + $row['mark'] ."%". "%0A";
        }

        $msg = "<b>Name : $name</b>%0A";
        $msg .= $marks;
        $msg .= "<b>Total : $total</b>";
    } else {
        $msg = "Please enter you valid roll number!";
    }
}

$token = "2032409974:AAHNbmvr8Hre1TRvBrQ6xVADjM3oHrz1cIA";
$send_msg = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$msg&parse_mode=HTML";

file_get_contents($send_msg);
