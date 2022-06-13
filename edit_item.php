<?php

if (!file_exists("data.json")) {
    $defaultData = file_get_contents("default_data.json");
    file_put_contents($this->filePath, $defaultData);
}


if (isset($_GET["item"]) && isset($_GET["title"]) && isset($_GET["show"])) {
    $item = $_GET["item"];
    $title = $_GET["title"];
    $show = $_GET["show"];

    $data = $data = file_get_contents($this->filePath);
    $data = json_decode($data, true);

    $data[$id]["title"] = $title;
    $data[$id]["showTitle"] = $show;

    file_put_contents("data.json", json_encode($data));
} else {
    header("HTTP/1.0 404 Not Found");
}
