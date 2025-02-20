<?php 

namespace App\Core;
use App\Core\View;
use App\Core\Router;
use App\Core\Request;
use App\Core\Session;
use App\Core\DB\Database;
use App\Core\Response;
use App\Core\Controller;
use App\Core\DB\DbModel;


class Application
{
    public static string $basePath;

    public string $layout = 'main';
    public string $userClass;
    public Request $request;
    public Response $response;
    public Router $router;
    public Session $session;
    public Database $db;
    public ?DbModel $user;
    public View $view;


    public static Application $app;
    public ?Controller $controller = null;
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
        $this->view = new View();

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
        try {
            echo $this->router->resolve();
        } catch (\Exception $th) {
            $this->response->setStatusCode($th->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $th
            ]);
        }
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