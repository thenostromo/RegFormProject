<?php
namespace Core\Manager;

use Core\Entity\User;
use Core\Exception\InvalidDataException;
use Core\Exception\WrongCredentialsException;
use Core\Manager\DatabaseManager;
use Core\Exception\EmptyRequiredParamsException;
use Core\Exception\UserAlreadyExistException;
use Core\Model\UserModel;
use Core\Provider\GeneralProvider;
use Core\Response\ApiResponse;
use Core\Validator\FormValidator;

class UserManager
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @var SessionManager
     */
    private $sessionManager;

    /**
     * @var FileManager
     */
    private $fileManager;

    public function __construct()
    {
        $this->databaseManager = new DatabaseManager();
        $this->sessionManager = new SessionManager();
        $this->fileManager = new FileManager();
    }

    /**
     * @param array $request
     * @throws EmptyRequiredParamsException
     * @throws InvalidDataException
     * @throws UserAlreadyExistException
     */
    public function createUser(array $request)
    {
        $username = array_key_exists("username", $request) ? $request["username"] : null;
        $password = array_key_exists("password", $request) ? $request["password"] : null;
        $email = array_key_exists("email", $request) ? $request["email"] : null;
        $fullname = array_key_exists("fullname", $request) ? $request["fullname"] : null;
        $avatar = array_key_exists("avatar", $request) ? $request["avatar"] : null;

        if (!$username || !$password || !$email || !$fullname) {
            throw new EmptyRequiredParamsException();
        }

        $userModel = new UserModel();
        $userModel->username = FormValidator::prepareData($username);
        $userModel->password = FormValidator::prepareData($password);
        $userModel->email = FormValidator::prepareData($email);
        $userModel->fullname = FormValidator::prepareData($fullname);
        $userModel->avatar = FormValidator::prepareData($avatar);

        if (!FormValidator::isValidRegForm($userModel)) {
            throw new InvalidDataException();
        }

        if ($this->databaseManager->isUserExist($userModel)) {
            throw new UserAlreadyExistException();
        }

        if ($avatar && $avatar !== "null") {
            $newPath = $this->fileManager->moveToAvatarStorage($userModel->avatar);
            $userModel->avatar = $newPath;
        }
        $this->databaseManager->createUser($userModel);
    }

    /**
     * @param array $request
     * @throws EmptyRequiredParamsException
     * @throws InvalidDataException
     * @throws WrongCredentialsException
     */
    public function authUser(array $request)
    {
        $username = array_key_exists("username", $request) ? $request["username"] : null;
        $password = array_key_exists("password", $request) ? $request["password"] : null;

        if (!$username || !$password) {
            throw new EmptyRequiredParamsException();
        }

        $userModel = new UserModel();
        $userModel->username = FormValidator::prepareData($username);
        $userModel->password = FormValidator::prepareData($password);

        if (!FormValidator::isValidAuthForm($userModel)) {
            throw new InvalidDataException();
        }

        $userInfo = $this->databaseManager->getUserInfo($userModel);

        if (!$userInfo) {
            throw new WrongCredentialsException();
        }

        $user = new User();
        $user->makeFromArray($userInfo);

        $this->sessionManager->sessionStart($user);
    }
}