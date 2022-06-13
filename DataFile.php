<?php

class DataFile {
    private $filePath = "data.json";

    public function __construct() {
        if (!file_exists($this->filePath)) {
            $defaultData = file_get_contents("default_data.json");
            file_put_contents($this->filePath, $defaultData);
        }
    }

    public function getData() {
        $data = file_get_contents($this->filePath);
        return json_decode($data, true);
    }

    public function editData(int $index , string $newTitle, bool $showTitle) {
        $data = $this->getData();
        $data[$index]["title"] = $newTitle;
        $data[$index]["showTitle"] = $showTitle;

        file_put_contents($this->filePath, json_encode($data));
    }
}

