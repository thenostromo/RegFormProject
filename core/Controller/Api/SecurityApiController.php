<?php
namespace Core\Controller\Api;

use Core\Exception\EmptyRequiredParamsException;
use Core\Exception\InvalidDataException;
use Core\Exception\UserAlreadyExistException;
use Core\Exception\WrongCredentialsException;
use Core\Manager\FileManager;
use Core\Provider\GeneralProvider;
use Core\Provider\InterfaceProvider;
use Core\Response\ApiResponse;
use Core\Manager\UserManager;

class SecurityApiController
{
    /**
     * @var FileManager
     */
    private $fileManager;

    public function __construct()
    {
        $this->fileManager = new FileManager();
    }

    /**
     * @param array $request
     * @return string
     */
    public function createUser(array $request)
    {
        $response = null;
        try {
            $userManager = new UserManager();
            $userManager->createUser($request);
            $response = new ApiResponse(GeneralProvider::API_RESPONSE_STATUS_SUCCESS);
        } catch (EmptyRequiredParamsException $ex) {
            $response = new ApiResponse(
                GeneralProvider::API_RESPONSE_STATUS_FAILED,
                InterfaceProvider::getInterfaceMessage("form_error_api.empty_required_parameters")
            );
        } catch (UserAlreadyExistException $ex) {
            $response = new ApiResponse(
                GeneralProvider::API_RESPONSE_STATUS_FAILED,
                InterfaceProvider::getInterfaceMessage("form_error_api.user_already_exist")
            );
        } catch (InvalidDataException $ex) {
            $response = new ApiResponse(
                GeneralProvider::API_RESPONSE_STATUS_FAILED,
                InterfaceProvider::getInterfaceMessage("form_error_api.invalid_data")
            );
        }

        return json_encode($response);
    }

    /**
     * @param array $request
     * @return string
     */
    public function authUser(array $request)
    {
        $response = null;
        try {
            $userManager = new UserManager();
            $userManager->authUser($request);
            $response = new ApiResponse(GeneralProvider::API_RESPONSE_STATUS_SUCCESS);
        } catch (EmptyRequiredParamsException $ex) {
            $response = new ApiResponse(
                GeneralProvider::API_RESPONSE_STATUS_FAILED,
                InterfaceProvider::getInterfaceMessage("form_error_api.empty_required_parameters")
            );
        } catch (WrongCredentialsException $ex) {
            $response = new ApiResponse(
                GeneralProvider::API_RESPONSE_STATUS_FAILED,
                InterfaceProvider::getInterfaceMessage("form_error_api.wrong_credentials")
            );
        } catch (InvalidDataException $ex) {
            $response = new ApiResponse(
                GeneralProvider::API_RESPONSE_STATUS_FAILED,
                InterfaceProvider::getInterfaceMessage("form_error_api.invalid_data")
            );
        }

        return json_encode($response);
    }

    /**
     * @param array $files
     * @return string
     */
    public function saveFile(array $files)
    {
        $path = null;
        if (count($files) > 0) {
            $path = $this->fileManager->moveToTmp($files['file']);
        }
        return json_encode(["filePath" => $path]);
    }
}