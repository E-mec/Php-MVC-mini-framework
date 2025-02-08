<?php

namespace App\Core;

class Controller
{
    public string $layout = 'main';
    public function setLayout($layout): void
    {
        $this->layout = $layout;
    }
    public function render($view, $params=[])
    {
        return Application::$app->router->renderView($view, $params);
    }
}