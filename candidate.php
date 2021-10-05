<?php

include_once './db.php';
$db = new Connect;

//$bot = https://t.me/bdsofcr_bot

//Get message info
$input = file_get_contents("php://input");
$data = json_decode($input);
$chat_id = $data->message->chat->id;
$text = $data->message->text;

if ($text == "/start") {
    $msg = "Welcome! please enter your roll number:";
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

        while ($row = mysqli_fetch_assoc($result)) {
            $marks .= $row['subject'] . " : " . $row['mark'] ."%". "%0A";
        }

        $msg = "<b>Name : $name</b>%0A";
        $msg .= $marks;
    } else {
        $msg = "Please enter you valid roll number!";
    }
}

$token = "2026548842:AAE52wMvxNWqqFPpA9OnyJKo2YVnBxiYvm0";
$send_msg = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$msg&parse_mode=HTML";

file_get_contents($send_msg);
