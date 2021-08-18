<?php
namespace app\core;


/**
 * @author Babatunde Adenowo
 * @package app\core
 */
class Application
{
    public static Application $app;
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    private Controller $controller;

    public function __construct($root) {
        self::$app = $this;
        self::$ROOT_DIR = $root;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function run() {
        echo $this->router->resolve();
    }
}