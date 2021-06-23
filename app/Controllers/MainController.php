<?php

namespace App\Controllers;

use App\Base\BasicAuth;
use App\Base\Controller;
use App\Models\MainModel;

class MainController extends Controller
{

    public function indexAction()
    {
        $model = new MainModel();
        $data = $model->get_data();
        $this->render("index", "main", $data);
    }
    public function addAction()
    {
        if (!empty($_POST['start']) && !empty($_POST['end'])) {
            $model = new MainModel();
            $model->start = $_POST['start'];
            $model->end = $_POST['end'];
            $model->save();
        }
        $this->home();
    }
    public function editAction()
    {
        if (BasicAuth::isAdmin()) {
            MainModel::editCheck($_GET['id']);
        }
        $this->home();
    }
}
