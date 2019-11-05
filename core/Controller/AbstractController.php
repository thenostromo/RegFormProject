<?php
namespace Core\Controller;

use Core\Manager\SessionManager;
use Core\Provider\RouteProvider;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Core\Provider\InterfaceProvider;

abstract class AbstractController
{
    /**
     * @var FilesystemLoader
     */
    protected $loader;

    /**
     * @var Environment
     */
    protected $twig;

    /**
     * @var SessionManager
     */
    protected $sessionManager;

    /**
     * @var RouteProvider
     */
    protected $routeProvider;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../templates');
        $this->twig = new Environment($this->loader);
        $this->sessionManager = new SessionManager();
        $this->routeProvider = new RouteProvider();
    }

    /**
     * @param string $template
     * @param array $params
     * @return string
     */
    protected function renderTemplate(string $template, array $params = [])
    {
        $params['interface'] = InterfaceProvider::getInterfaceMessages();
        $params["hostWithScheme"] = $this->routeProvider->getRoute(RouteProvider::HOST_WITH_SCHEME, RouteProvider::IS_FULL_URL);
        try {
            return $this->twig->render($template, $params);
        } catch (\Twig\Error\Error $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * @param string $url
     */
    protected function redirect($url)
    {
        header('Location: ' . $url,true, 301);
    }
}