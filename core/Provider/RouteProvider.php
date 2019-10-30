<?php
namespace Core\Provider;

class RouteProvider
{
    const SECURITY_CONTROLLER_LOGIN = "login";
    const PROFILE_CONTROLLER_VIEW = "view";
    const DEFAULT_CONTROLLER_HOMEPAGE = "/";
    const DEFAULT_CONTROLLER_ABOUT = "about";
    const SECURITY_CONTROLLER_REGISTRATION = "registration";
    const HOST_WITH_SCHEME = "hostWithScheme";
    const SECURITY_CONTROLLER_LOGOUT = "logout";

    const API_SECURITY_CONTROLLER_CREATE_USER = "createUser";
    const API_SECURITY_CONTROLLER_AUTH_USER = "authUser";
    const API_SECURITY_CONTROLLER_SAVE_FILE = "saveFile";

    const IS_FULL_URL = true;
    const IS_NOT_FULL_URL = false;

    /**
     * @param string $controller
     * @param bool $isFullUrl
     * @return string|null
     */
    public static function getRoute($controller, $isFullUrl = self::IS_NOT_FULL_URL)
    {
        $mainUrl = null;
        if ($isFullUrl) {
            $mainUrl = sprintf("%s%s",
                (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http"),
                "://$_SERVER[HTTP_HOST]"
            );
        }
        switch (true) {
            case($controller === self::API_SECURITY_CONTROLLER_CREATE_USER
                || $controller === self::API_SECURITY_CONTROLLER_AUTH_USER
                || $controller === self::API_SECURITY_CONTROLLER_SAVE_FILE):
                return sprintf("%s/api/%s", $mainUrl, $controller);
                break;
            case($controller === self::DEFAULT_CONTROLLER_ABOUT
                || $controller === self::SECURITY_CONTROLLER_REGISTRATION
                || $controller === self::SECURITY_CONTROLLER_LOGIN
                || $controller === self::SECURITY_CONTROLLER_LOGOUT):
                return sprintf("%s/%s", $mainUrl, $controller);
                break;
            case($controller === self::PROFILE_CONTROLLER_VIEW):
                return sprintf("%s/profile/%s", $mainUrl, self::PROFILE_CONTROLLER_VIEW);
                break;
            case($controller === self::DEFAULT_CONTROLLER_HOMEPAGE
                || $controller === self::HOST_WITH_SCHEME):
                return ($isFullUrl) ? $mainUrl : self::DEFAULT_CONTROLLER_HOMEPAGE;
            default:
                return null;
        }
    }
}