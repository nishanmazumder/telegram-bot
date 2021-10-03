<?php

// $ch = curl_init();

// $url = "http://telebot.bdsoftcreation.com/index.php";

// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_TIMEOUT, 3000);

// $arr = ["name" => "NISHAN"];

// curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);

// $result = curl_exec($ch);

// print_r($result);

// curl_close($ch);

if(isset($_POST['submit'])){

$token = "2026548842:AAE52wMvxNWqqFPpA9OnyJKo2YVnBxiYvm0";
$text = $_POST['msg'];

$chat_id = 2037102579;

$send_msg = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$text";

$ch =  curl_init();
curl_setopt($ch, CURLOPT_URL, $send_msg);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$result = json_decode($result, true);

// echo '<pre>'; 
// print_r($result);

curl_close($ch);

}
?>


<form action="" method="post">
	<input type="text" name="msg" id="">
	<input type="submit" name="submit" value="Send">
</form>
