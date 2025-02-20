<?php

namespace App\Core;

class View
{
    public string $title = '';


    public function renderView($view, $params =[])
    {
        $viewContent = $this->renderOnlyView($view, $params);
        $layoutContent = $this->layoutContent();

        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app->layout;
        if(Application::$app->controller){
        $layout = Application::$app->controller->layout;
        }
        ob_start();
        include_once Application::$basePath . "/views/Layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value)
        {
            $$key = $value;
        }
        ob_start();
        include_once Application::$basePath . "/views/$view.php";
        return ob_get_clean();
    }
}