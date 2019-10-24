<?php
namespace Core\Provider;

class RouteProvider
{
    const API_SECURITY_CONTROLLER_CREATE_USER = "createUser";

    /**
     * @param string $controller
     * @return string|null
     */
    public static function getApiRoute($controller)
    {
        $mainUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        switch (true) {
            case($controller === self::API_SECURITY_CONTROLLER_CREATE_USER):
                return sprintf("%s/api/%s", $mainUrl, self::API_SECURITY_CONTROLLER_CREATE_USER);
                break;
            default:
                return null;
        }
    }
}