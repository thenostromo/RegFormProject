<?php
namespace Core\Provider;

class RouteProvider
{
    const SECURITY_CONTROLLER_LOGIN = "login";
    const PROFILE_CONTROLLER_VIEW = "view";
    const DEFAULT_CONTROLLER_HOMEPAGE = "/";
    const HOST_WITH_SCHEME = "hostWithScheme";
    const SECURITY_CONTROLLER_LOGOUT = "logout";

    const API_SECURITY_CONTROLLER_CREATE_USER = "createUser";
    const API_SECURITY_CONTROLLER_AUTH_USER = "authUser";
    const API_SECURITY_CONTROLLER_SAVE_FILE = "saveFile";

    /**
     * @param string $controller
     * @return string|null
     */
    public static function getRoute($controller)
    {
        $mainUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        switch (true) {
            case($controller === self::API_SECURITY_CONTROLLER_CREATE_USER):
                return sprintf("%s/api/%s", $mainUrl, self::API_SECURITY_CONTROLLER_CREATE_USER);
                break;
            case($controller === self::API_SECURITY_CONTROLLER_AUTH_USER):
                return sprintf("%s/api/%s", $mainUrl, self::API_SECURITY_CONTROLLER_AUTH_USER);
                break;
            case($controller === self::API_SECURITY_CONTROLLER_SAVE_FILE):
                return sprintf("%s/api/%s", $mainUrl, self::API_SECURITY_CONTROLLER_SAVE_FILE);
                break;
            case($controller === self::DEFAULT_CONTROLLER_HOMEPAGE):
                return $mainUrl;
                break;
            case($controller === self::SECURITY_CONTROLLER_LOGIN):
                return sprintf("%s/%s", $mainUrl, self::SECURITY_CONTROLLER_LOGIN);
                break;
            case($controller === self::SECURITY_CONTROLLER_LOGOUT):
                return sprintf("%s/%s", $mainUrl, self::SECURITY_CONTROLLER_LOGOUT);
                break;
            case($controller === self::PROFILE_CONTROLLER_VIEW):
                return sprintf("%s/profile/%s", $mainUrl, self::PROFILE_CONTROLLER_VIEW);
                break;
            case($controller === self::HOST_WITH_SCHEME):
                return $mainUrl;
            default:
                return null;
        }
    }
}