<?php
namespace Core\Controller;

use Core\Entity\User;
use Core\Manager\SessionManager;
use Core\Provider\RouteProvider;

class ProfileController extends AbstractController
{
    /**
     * @return string
     */
    public function view()
    {
        if (!$this->sessionManager->isAuthUser()) {
            $this->redirect(RouteProvider::getRoute(RouteProvider::SECURITY_CONTROLLER_LOGIN, RouteProvider::IS_FULL_URL));
        }
        $user = new User();
        $user->loadFromSession($this->sessionManager->getSessionInfo());

        return $this->renderTemplate('profile/view.html.twig', [
            "user" => $user,
            "urlLogout" => RouteProvider::getRoute(RouteProvider::SECURITY_CONTROLLER_LOGOUT, RouteProvider::IS_FULL_URL)
        ]);
    }
}