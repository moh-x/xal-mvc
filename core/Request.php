<?php

namespace app\core;

class Request
{
    public function path() {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $hasQueryParams = strpos($path, '?');

        if ($hasQueryParams) {
            $path = substr($path, 0, $hasQueryParams);
        }
        return $path;
    }

    public function method() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet() { return $this->method() === 'get'; }
    public function isPost() { return $this->method() === 'post'; }

    public function body() {
        $body = [];

        switch ($this->method()) {
            case "get":
                foreach ($_GET as $data => $value) {
                    $body[$data] = filter_input(INPUT_GET, $data, FILTER_SANITIZE_SPECIAL_CHARS);
                }
                break;
            case "post":
                foreach ($_POST as $data => $value) {
                    $body[$data] = filter_input(INPUT_POST, $data, FILTER_SANITIZE_SPECIAL_CHARS);
                }
                break;
        }
        return $body;
    }
}