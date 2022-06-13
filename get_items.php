<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

if (!file_exists("data.json")) {
    $defaultData = file_get_contents("default_data.json");
    file_put_contents("data.json", $defaultData);
}

$data = file_get_contents("data.json");
echo $data;