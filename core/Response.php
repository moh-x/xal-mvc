<?php

namespace app\core;

class Response
{

//    TODO: Might make private or protected.
    public function setStatusCode(int $code) {
        http_response_code($code);
    }

}