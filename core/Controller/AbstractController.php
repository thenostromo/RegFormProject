<?php
namespace Core\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

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

    public function __construct()
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../templates');
        $this->twig = new Environment($this->loader);
    }

    /**
     * @param string $template
     * @param array $params
     * @return string|Environment
     */
    protected function renderTemplate(string $template, array $params = [])
    {
        try {
            return $this->twig->render($template, $params);
        } catch (\Twig\Error\Error $ex) {
            echo $ex->getMessage();
        }
    }
}