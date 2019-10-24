<?php
namespace Core\Controller;

use Core\Model\UserModel;
use Core\Provider\RouteProvider;

class SecurityController extends AbstractController
{
    /**
     * @param array $request
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function login(array $request)
    {
        return $this->renderTemplate('security/login.html.twig');
    }

    /**
     * @param array $request
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function registration(array $request)
    {
        $userModel = new UserModel();
        return $this->renderTemplate('security/registration.html.twig', [
            'userModel' => json_encode($userModel),
            'urlCreateUser' => RouteProvider::getApiRoute(RouteProvider::API_SECURITY_CONTROLLER_CREATE_USER)
        ]);
    }
}