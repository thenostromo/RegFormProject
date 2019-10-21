<?php
namespace Core\Controller;

class DefaultController extends AbstractController
{
    /**
     * @param array $request
     * @return string
     */
    public function homepage(array $request)
    {
        return $this->renderTemplate('default/homepage.html.twig');
    }

    /**
     * @param array $request
     * @return string|\Twig\Environment
     */
    public function about(array $request)
    {
        return $this->renderTemplate('default/about.html.twig');
    }

    /**
     * @param array $request
     * @return string
     */
    public function error404(array $request)
    {
        return $this->renderTemplate('error/404.html.twig');
    }
}