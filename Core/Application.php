<?php 

namespace App\Core;
use App\Core\Router;
use App\Core\Database;


class Application
{
    public static string $basePath;
    public Request $request;
    public Response $response;
    public Router $router;

    public Database $db;
    public static Application $app;
    public Controller $controller;
    public function __construct($rootPath, array $config)
    {
        self::$basePath = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->db = new Database($config['db']);
        $this->router = new Router($this->request, $this->response);
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController(Controller $controller)
    {
        $this->controller = $controller;
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}