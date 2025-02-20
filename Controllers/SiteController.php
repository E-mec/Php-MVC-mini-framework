<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Controller;
use App\Core\Application;
use App\Models\ContactForm;

class SiteController extends Controller
{
    public function home()
    {
        $param = [
            'name' => "Exxon"
        ];

        return $this->render('home', $param);
    }

    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();

        if($request->isPost())
        {
            $contact->loadData($request->getBody());

            if($contact->validate() && $contact->send())
            {
                Application::$app->session->setFlash('success', 'Thanks for contacting us. We will get back to you soon');
                return $response->redirect('contact');
            }
        }
        return $this->render('contact',[
            'model' => $contact,
        ]
    );
    }
}