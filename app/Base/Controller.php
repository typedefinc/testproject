<?php

namespace App\Base;

class Controller
{
    public $model;
    public $view;

    public function render($content, $template, $data = null)
    {
        include_once "app/Views/layout/" . $template . ".php";
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
