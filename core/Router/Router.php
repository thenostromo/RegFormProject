<?php
namespace Core\Router;

use Core\Controller\Api\SecurityApiController;
use Core\Controller\DefaultController;
use Core\Controller\ProfileController;
use Core\Controller\SecurityController;
use Core\Provider\RouteProvider;

class Router
{
    /**
     * @var array
     */
    private $controllers;

    /**
     * @var RouteProvider
     */
    private $routeProvider;

    public function __construct()
    {
        $this->routeProvider = new RouteProvider();
        $this->controllers = [
            'default' => new DefaultController(),
            'security' => new SecurityController(),
            'profile' => new ProfileController(),
            'securityApi' => new SecurityApiController()
        ];
    }

    /**
     * @param array $request
     * @return string
     */
    public function handleRequest()
    {
        $url = $_SERVER['REQUEST_URI'];

        $response = null;
        $response = $this->handleApiRequests($url, $_POST);
        if (!$response) {
            $response = $this->handleMainPages($url, $_POST);
        }
        return (!$response)
            ? $this->controllers['default']->error404()
            : $response;
    }

    /**
     * @param string $url
     * @param array $request
     * @return mixed
     */
    private function handleApiRequests(string $url, array $request = [])
    {
        switch($url) {
            case($this->routeProvider->getRoute(RouteProvider::API_SECURITY_CONTROLLER_CREATE_USER)):
                return $this->controllers['securityApi']->createUser($request);
                break;
            case($this->routeProvider->getRoute(RouteProvider::API_SECURITY_CONTROLLER_AUTH_USER)):
                return $this->controllers['securityApi']->authUser($request);
                break;
            case($this->routeProvider->getRoute(RouteProvider::API_SECURITY_CONTROLLER_SAVE_FILE)):
                return $this->controllers['securityApi']->saveFile($_FILES);
                break;
        }
    }

    /**
     * @param string $url
     * @param array $request
     * @return string
     */
    private function handleMainPages(string $url, array $request = [])
    {
        switch($url) {
            case($this->routeProvider->getRoute(RouteProvider::DEFAULT_CONTROLLER_HOMEPAGE)):
                return $this->controllers['default']->homepage();
                break;
            case($this->routeProvider->getRoute(RouteProvider::DEFAULT_CONTROLLER_ABOUT)):
                return $this->controllers['default']->about();
                break;
            case($this->routeProvider->getRoute(RouteProvider::SECURITY_CONTROLLER_LOGIN)):
                return $this->controllers['security']->login();
                break;
            case($this->routeProvider->getRoute(RouteProvider::SECURITY_CONTROLLER_LOGOUT)):
                return $this->controllers['security']->logout();
                break;
            case($this->routeProvider->getRoute(RouteProvider::SECURITY_CONTROLLER_REGISTRATION)):
                return $this->controllers['security']->registration();
                break;
            case($this->routeProvider->getRoute(RouteProvider::PROFILE_CONTROLLER_VIEW)):
                return $this->controllers['profile']->view();
                break;
        }
    }
}