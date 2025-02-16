<?php 

namespace App\Core;
use App\Core\Router;
use App\Core\Database;


class Application
{
    public static string $basePath;

    public string $userClass;
    public Request $request;
    public Response $response;
    public Router $router;
    public Session $session;
    public Database $db;
    public ?DbModel $user;


    public static Application $app;
    public Controller $controller;
    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$basePath = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->db = new Database($config['db']);
        $this->router = new Router($this->request, $this->response);

        $primaryValue = $this->session->get('user');

        if ($primaryValue){
            $primaryKey = $this->userClass::primaryKey();
        $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }else{
            $this->user = null;
        }
    }

    public static function isGuest()
    {
        return !self::$app->user;
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

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }
}   