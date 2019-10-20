<?php
namespace Core\Router;

use Core\Controller\DefaultController;

class Router
{
    /**
     * @var array
     */
    private $controllers;

    public function __construct()
    {
        $this->controllers = [
            'default' => new DefaultController()
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

        var_dump($request); exit();
    }
}