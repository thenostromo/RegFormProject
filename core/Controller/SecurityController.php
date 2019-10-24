<?php
namespace Core\Controller;

use Core\Model\UserModel;
use Core\Provider\RouteProvider;

class SecurityController extends AbstractController
{
    /**
     * @return string
     */
    public function login()
    {
        $userModel = new UserModel();
        if ($this->sessionManager->isAuthUser()) {
            $this->redirect(RouteProvider::getRoute(RouteProvider::PROFILE_CONTROLLER_VIEW));
        }
        return $this->renderTemplate('security/login.html.twig', [
            'userModel' => json_encode($userModel),
            'urlAuthUser' => RouteProvider::getRoute(RouteProvider::API_SECURITY_CONTROLLER_AUTH_USER),
            'urlProfileUser' => RouteProvider::getRoute(RouteProvider::PROFILE_CONTROLLER_VIEW),
        ]);
    }

    /**
     * @return string
     */
    public function logout()
    {
        $this->sessionManager->sessionStop();
        $this->redirect(RouteProvider::getRoute(RouteProvider::DEFAULT_CONTROLLER_HOMEPAGE));
    }

    /**
     * @return string
     */
    public function registration()
    {
        $userModel = new UserModel();
        if ($this->sessionManager->isAuthUser()) {
            $this->redirect(RouteProvider::getRoute(RouteProvider::PROFILE_CONTROLLER_VIEW));
        }
        return $this->renderTemplate('security/registration.html.twig', [
            'userModel' => json_encode($userModel),
            'urlSaveFile' => RouteProvider::getRoute(RouteProvider::API_SECURITY_CONTROLLER_SAVE_FILE),
            'urlCreateUser' => RouteProvider::getRoute(RouteProvider::API_SECURITY_CONTROLLER_CREATE_USER),
            'urlLoginPage' => RouteProvider::getRoute(RouteProvider::SECURITY_CONTROLLER_LOGIN),
        ]);
    }
}