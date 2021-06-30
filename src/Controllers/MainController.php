<?php

namespace App\Controllers;

use Slim\App;
use App\Controller;
use App\Auth;
use App\Models\VacationModel;
use App\Models\UserModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MainController extends Controller
{
    private VacationModel $vacationModel;
    private UserModel $userModel;

    public function __construct(VacationModel $vacationModel, UserModel $userModel)
    {
        $this->vacationModel = $vacationModel;
        $this->userModel = $userModel;
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
        if (Auth::isAdmin()) {
            $data = $request->getParsedBody();

            if ($data) {
                  $model = $this->vacationModel;
                  $model->author = 'user';
                  $model->start = $data['start'];
                  $model->end =  $data['end'];
                  $model->save();
            }
        }
        return $response->withHeader('Location', '/');
    }

    public function edit($request, $response, $args)
    {
        if (Auth::isAdmin()) {
            $model = $this->vacationModel;
            $model->editCheck($args['id']);
        }

        return $response->withHeader('Location', '/');
    }

    public function login($request, $response)
    {
        if ($request->getMethod() == 'POST') {
            $data = $request->getParsedBody();
            $model = $this->userModel;
            if ($model->validate($data['username'], $data['password'])) {
                $_SESSION['logged'] = true;
                $user = $model->getInfoUser($data['username']);
                $_SESSION['uinfo'] = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role
                ];
                return $response->withHeader('Location', '/');
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
