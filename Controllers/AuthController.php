<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Controller;
use App\Core\Application;
use App\Models\RegisterModel;

class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('auth');

        return $this->render('login');
    }

    public function register(Request $request)
    {
        $errors = [];

        $registerModel = new RegisterModel();
        if ($request->isPost()) 
        {
            $registerModel->loadData($request->getBody());
            
            if ($registerModel->validate() && $registerModel->register())
            {
                return 'Success';
            }
            // echo '<pre>';
            // var_dump($registerModel->errors);
            // echo '</pre>';

            // die();

            return $this->render('register',[
                'model' => $registerModel,
            ]);
        }

        $this->setLayout('auth');

        return $this->render('register',[
            'model' => $registerModel,
        ]);
    }
}
