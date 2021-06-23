<?php

namespace App\Controllers;

use App\Base\BasicAuth;
use App\Base\Controller;
use App\Models\ListModel;

class MainController extends Controller
{

    public function indexAction()
    {
        $model = new ListModel();
        $data = $model->getData();
        $this->render("index", "main", $data);
    }
    public function addAction()
    {
        if (!empty($_POST['start']) && !empty($_POST['end'])) {
            $model = new ListModel();
            $model->author = $_SERVER['PHP_AUTH_USER'];
            $model->start = $_POST['start'];
            $model->end = $_POST['end'];
            $model->save();
        }
        $this->home();
    }
    public function editAction()
    {
        if (BasicAuth::isAdmin()) {
            ListModel::editCheck($_GET['id']);
        }
        $this->home();
    }
}
