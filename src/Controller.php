<?php

namespace App;

class Controller
{

    public function render($content, $template, $data = null)
    {
        include_once "Views/layout/" . $template . ".php";
    }

    public function home()
    {
        $this->redirect("/");
    }

    public function redirect($url)
    {
        header("Location:$url");
    }
}
