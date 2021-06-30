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

    public function index($request, $response)
    {
        $model = $this->vacationModel;
        $data = $model->getData();
        $this->render("index", "main", $data);
        return $response;
    }

    public function add($request, $response)
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

    public function edit($request, $response, $args)
    {
        $model = $this->vacationModel;
        $model->editCheck($args['id']);
        return $response->withHeader('Location', '/');
    }

    public function login($request, $response)
    {
        if ($request->getMethod() == 'POST') {
            $data = $request->getParsedBody();
            if ($data['username'] == 'admin') {
                if ($data['password'] == 'admin') {
                    $_SESSION['logged'] = true;
                    return $response->withHeader('Location', '/');
                }
            }
        }
        $this->render('login', 'main');
        return $response;
    }

    public function logout($request, $response)
    {
        if ($_SESSION['logged']) {
            if ($_SESSION['logged']) {
                $_SESSION = array();
                return $response->withHeader('Location', '/auth/login');
            }
        } else {
            return $response->withHeader('Location', '/auth/login');
        }
            return $response;
    }
}
