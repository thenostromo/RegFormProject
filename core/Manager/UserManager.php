<?php
namespace Core\Manager;

use Core\Entity\User;
use Core\Manager\DatabaseManager;
use Core\Exception\EmptyRequiredParamsException;
use Core\Provider\GeneralProvider;
use Core\Response\ApiResponse;
use Core\Validator\FormValidator;

class UserManager
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    public function __construct()
    {
        $this->databaseManager = new DatabaseManager();
    }

    /**
     * @param array $request
     * @return bool
     * @throws EmptyRequiredParamsException
     */
    public function createUser(array $request)
    {
        $username = array_key_exists("username", $request) ? $request["username"] : null;
        $password = array_key_exists("password", $request) ? $request["password"] : null;
        $email = array_key_exists("email", $request) ? $request["email"] : null;
        $fullname = array_key_exists("fullname", $request) ? $request["fullname"] : null;

        if (!$username || !$password || !$email || !$fullname) {
            throw new EmptyRequiredParamsException();
        }

        $user = new User();
        $user->setUsername(FormValidator::makeValidData($username));
        $user->setPassword(FormValidator::makeValidData($password));
        $user->setEmail(FormValidator::makeValidData($email));
        $user->setFullname(FormValidator::makeValidData($fullname));

        $this->databaseManager->addUser($user);
        return true;
    }
}