<?php
namespace Core\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class DefaultController
{
    private $loader;

    private $twig;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../templates');
        $this->twig = new Environment($this->loader);
    }

    public function homepage($request)
    {

        echo $this->twig->render('homepage.html.twig', ['name' => 'John Doe',
            'occupation' => 'gardener']);

    }
}