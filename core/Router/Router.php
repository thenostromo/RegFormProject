<?php
namespace Core\Router;

use Core\Controller\DefaultController;
use Core\Controller\SecurityController;

class Router
{
    /**
     * @var array
     */
    private $controllers;

    public function __construct()
    {
        $this->controllers = [
            'default' => new DefaultController(),
            'security' => new SecurityController()
        ];
    }

    /**
     * @param array $request
     * @return string
     */
    public function handleRequest(array $request)
    {
        if (!array_key_exists("path", $request)) {
            return $this->controllers['default']->homepage($request);
        }

        switch($request["path"]) {
            case("about"):
                return $this->controllers['default']->about($request);
            case("login"):
                return $this->controllers['security']->login($request);
            case("registration"):
                return $this->controllers['security']->registration($request);
            default:
                return $this->controllers['default']->error404($request);
        }

        var_dump($request); exit();
    }
}