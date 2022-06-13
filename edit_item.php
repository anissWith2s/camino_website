<?php

$dataFile = new DataFile();

if (isset($_GET["id"]) && isset($_GET["title"]) && isset($_GET["show"])) {
    $id = $_GET["id"];
    $title = $_GET["title"];
    $show = $_GET["show"];
    $data = $dataFile->getData();
    if (isset($data[$id])) {
        $dataFile->editData($id, $title, $show);
    }
} else {
    header("HTTP/1.0 404 Not Found");
}
