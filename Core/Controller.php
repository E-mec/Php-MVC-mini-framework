<?php

namespace App\Core;

use App\Core\middlewares\BaseMiddleware;

class Controller
{
    public string $layout = 'main';
    public string $action = '';
    protected array $middlewares = [];
    public function setLayout($layout): void
    {
        $this->layout = $layout;
    }
    public function render($view, $params=[])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $baseMiddleware)
    {
        $this->middlewares[] = $baseMiddleware; 
    }

    public function getMiddlewares()
    {
        return $this->middlewares;
    }
}