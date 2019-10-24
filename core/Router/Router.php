<?php
namespace Core\Router;

use Core\Controller\Api\SecurityApiController;
use Core\Controller\DefaultController;
use Core\Controller\ProfileController;
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
            case("/api/createUser"):
                return $this->controllers['securityApi']->createUser($request);
                break;
            case("/api/authUser"):
                return $this->controllers['securityApi']->authUser($request);
                break;
            case("/api/saveFile"):
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
            case("/"):
                return $this->controllers['default']->homepage();
                break;
            case("/about"):
                return $this->controllers['default']->about();
                break;
            case("/login"):
                return $this->controllers['security']->login();
                break;
            case("/logout"):
                return $this->controllers['security']->logout();
                break;
            case("/registration"):
                return $this->controllers['security']->registration();
                break;
            case("/profile/view"):
                return $this->controllers['profile']->view();
                break;
        }
    }
}