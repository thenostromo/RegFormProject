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
            $this->redirect(RouteProvider::getRoute(RouteProvider::PROFILE_CONTROLLER_VIEW, RouteProvider::IS_FULL_URL));
        }
        return $this->renderTemplate('security/login.html.twig', [
            'userModel' => json_encode($userModel),
            'urlAuthUser' => RouteProvider::getRoute(RouteProvider::API_SECURITY_CONTROLLER_AUTH_USER, RouteProvider::IS_FULL_URL),
            'urlProfileUser' => RouteProvider::getRoute(RouteProvider::PROFILE_CONTROLLER_VIEW, RouteProvider::IS_FULL_URL),
        ]);
    }

    /**
     * @return string
     */
    public function logout()
    {
        $this->sessionManager->sessionStop();
        $this->redirect(RouteProvider::getRoute(RouteProvider::DEFAULT_CONTROLLER_HOMEPAGE, RouteProvider::IS_FULL_URL));
    }

    /**
     * @return string
     */
    public function registration()
    {
        $userModel = new UserModel();
        if ($this->sessionManager->isAuthUser()) {
            $this->redirect(RouteProvider::getRoute(RouteProvider::PROFILE_CONTROLLER_VIEW, RouteProvider::IS_FULL_URL));
        }
        return $this->renderTemplate('security/registration.html.twig', [
            'userModel' => json_encode($userModel),
            'urlSaveFile' => RouteProvider::getRoute(RouteProvider::API_SECURITY_CONTROLLER_SAVE_FILE, RouteProvider::IS_FULL_URL),
            'urlCreateUser' => RouteProvider::getRoute(RouteProvider::API_SECURITY_CONTROLLER_CREATE_USER, RouteProvider::IS_FULL_URL),
            'urlLoginPage' => RouteProvider::getRoute(RouteProvider::SECURITY_CONTROLLER_LOGIN, RouteProvider::IS_FULL_URL),
        ]);
    }
}