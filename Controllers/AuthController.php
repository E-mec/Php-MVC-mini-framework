<?php

namespace App\Controllers;

use App\Core\Application;
use App\Core\Controller;
use App\Core\Request;

class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('auth');

        return $this->render('login');
    }

    public function register(Request $request)
    {
        if ($request->isPost()) 
        {
            $body = $request->getBody();

            var_dump($body);

            return "handling POST requests";
        }

        $this->setLayout('auth');

        return $this->render('register');
    }
}
