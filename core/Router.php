<?php
namespace app\core;

/**
 * @author Babatunde Adenowo
 * @package app\core
 */
class Router
{
    public Request $request;
    public response $response;
    protected array $routes = [];

    /**
     * @param Request $request
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get(string $path, $callback) {
        $this->routes[$path]['get'] = $callback;
    }

    public function post(string $path, $callback) {
        $this->routes[$path]['post'] = $callback;
    }

    public function resolve() {
        $path = $this->request->path();
        $method = $this->request->method();
        $callback = $this->routes[$path][$method];

//        TODO: Better path and method specific error handling.
        if (!$callback) {
//            TODO: change to handleStatus and move all the
//              handling in there.
            $this->response->setStatusCode(404);
//            TODO: Reformat to handle all status codes.
            //        TODO: Make this an instance.
            return file_exists(Application::$ROOT_DIR."/views/_404.php") ?
                $this->renderView("_404")
                : $this->renderContent("404 Not Found!");
        }

        if (is_string($callback)) { return $this->renderView($callback); }
        if (is_array($callback)) {
            Application::$app->setController(new $callback[0]());
            $callback[0] = Application::$app->getController();
        }

        return call_user_func($callback, $this->request);
    }

    public function renderView(string $view, $params = []) {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
//        TODO: make the search for tags dynamic
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    private function renderContent(string $content) {
        $layoutContent = $this->layoutContent();
//        TODO: Handle when there are error templates
        return str_replace('{{content}}', $content, $layoutContent);
    }

    protected function layoutContent() {
        $layout = Application::$app->getController()->layout;
        ob_start();
//        TODO: Make this an instance.
        include_once Application::$ROOT_DIR."/views/layouts/${layout}.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params) {
        foreach ($params as $param => $value) {
            $$param = $value;
        }

        ob_start();
//        TODO: Make this an instance.
        include_once Application::$ROOT_DIR."/views/${view}.php";
        return ob_get_clean();
    }

}