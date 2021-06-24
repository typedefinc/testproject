<?php

namespace App\Controllers;

use App\Base\BasicAuth;
use App\Base\Controller;
use App\Models\VacationModel;

class MainController extends Controller
{

    public function indexAction()
    {
        $model = new VacationModel();
        $data = $model->getData();
        $this->render("index", "main", $data);
    }

    public function addAction()
    {
        if (!empty($_POST['start']) && !empty($_POST['end'])) {
            $model = new VacationModel();
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
            $model = new VacationModel();
            $model->editCheck($_GET['id']);
        }
        $this->home();
    }

}
