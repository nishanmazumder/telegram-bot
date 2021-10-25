<?php

    $text = "organisms";
    $text = urlencode(ucwords($text));
    $url = "https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro&explaintext&titles=$text";
    $data = file_get_contents($url);
    $data = json_decode($data, true);

    // if(isset($data['query']['pages'])){
    //     foreach ($data['query']['pages'] as $key => $val) {
    //         //$msg = "<h1>".urlencode($val['title'])."</h1>%0A";
    //         $msg = $val['title'];
    //         $msg .= $val['extract'];
    //         //$msg = urlencode($val['extract']);
    //     }
    // }else{
    //     $msg = "No data found!";
    // }

    echo '<pre>'; 
    print_r($data);

