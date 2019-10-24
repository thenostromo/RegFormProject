<?php
namespace Core\Router;

use Core\Controller\Api\SecurityApiController;
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
            'security' => new SecurityController(),
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
            case("/api/createUser"):
                return $this->controllers['securityApi']->createUser($request);
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
            case("/"):
                return $this->controllers['default']->homepage($request);
            case("/about"):
                return $this->controllers['default']->about($request);
            case("/login"):
                return $this->controllers['security']->login($request);
            case("/registration"):
                return $this->controllers['security']->registration($request);
        }
    }
}