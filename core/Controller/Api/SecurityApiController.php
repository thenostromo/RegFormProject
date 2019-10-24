<?php
namespace Core\Controller\Api;

use Core\Exception\EmptyRequiredParamsException;
use Core\Provider\GeneralProvider;
use Core\Response\ApiResponse;
use Core\Manager\UserManager;

class SecurityApiController
{
    /**
     * @param array $request
     * @return string
     */
    public function createUser(array $request)
    {
        try {
            $userManager = new UserManager();
            $userManager->createUser($request);
        } catch (EmptyRequiredParamsException $ex) {
            return json_encode(
                new ApiResponse(GeneralProvider::API_RESPONSE_STATUS_FAILED, "Empty required parameters", [])
            );
        }
        return json_encode(
            new ApiResponse(GeneralProvider::API_RESPONSE_STATUS_SUCCESS)
        );
    }
}