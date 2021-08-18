<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home() {
        $params = ['name' => "xodeeq"];

        return $this->render('home', $params);
    }

    public function contactGet() {
        return $this->render('contact');
    }

    public function contactPost(Request $request) {
        $body = $request->body();

        print_r($body);
    }
}