<?php

namespace App\Controllers;

use Slim\App;
use App\Controller;
use App\Models\VacationModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MainController extends Controller
{
    private VacationModel $vacationModel;

    public function __construct(VacationModel $vacationModel)
    {
        $this->vacationModel = $vacationModel;
    }

    public function indexAction($request, $response)
    {
        $model = $this->vacationModel;
        $data = $model->getData();
        $this->render("index", "main", $data);
        return $response;
    }

    public function addAction($request, $response)
    {
            $data = $request->getParsedBody();

        if ($data) {
            $model = $this->vacationModel;
            $model->author = 'user';
            $model->start = $data['start'];
            $model->end =  $data['end'];
            $model->save();
        }
        return $response->withHeader('Location', '/');
    }

    public function editAction($request, $response, $args)
    {
        $model = $this->vacationModel;
        $model->editCheck($args['id']);
        return $response->withHeader('Location', '/');
    }

    public function loginAction($request, $response)
    {
        $this->render('login', 'main');
        return $response;
    }
}
