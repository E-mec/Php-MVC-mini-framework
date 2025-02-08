<?php

namespace App\Controllers;

use App\Core\Application;
use App\Core\Controller;
use App\Core\Request;

class SiteController extends Controller
{
    public function home()
    {
        $param = [
            'name' => "Exxon"
        ];

        return $this->render('home', $param);
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();

        var_dump($body);


        return "Handling Submitted data";
    }
}