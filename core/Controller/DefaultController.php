<?php
namespace Core\Controller;

class DefaultController extends AbstractController
{
    /**
     * @return string
     */
    public function homepage()
    {
        return $this->renderTemplate('default/homepage.html.twig');
    }

    /**
     * @return string
     */
    public function about()
    {
        return $this->renderTemplate('default/about.html.twig');
    }

    /**
     * @return string
     */
    public function error404()
    {
        return $this->renderTemplate('error/404.html.twig');
    }
}