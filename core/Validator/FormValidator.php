<?php
namespace Core\Validator;

use Core\Model\UserModel;

class FormValidator
{
    /**
     * @param string $data
     * @return string
     */
    public static function prepareData($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * @param UserModel $userModel
     * @return bool
     */
    public static function isValidRegForm(UserModel $userModel)
    {
        return (self::isValidEmail($userModel->email)
            && self::isValidUsername($userModel->username)
            && self::isValidPassword($userModel->password)
            && self::isValidFullname($userModel->fullname)
        );
    }

    /**
     * @param UserModel $userModel
     * @return bool
     */
    public static function isValidAuthForm(UserModel $userModel)
    {
        return (self::isValidUsername($userModel->username) && self::isValidPassword($userModel->password));
    }

    /**
     * @param string $username
     * @return bool
     */
    public static function isValidUsername(string $username)
    {
        if (strlen($username) < 2 || strlen($username) > 30) {
            return false;
        }

        $matches = [];
        preg_match('/^[A-Za-z0-9_.-]*$/', $username, $matches);

        return (count($matches) > 0);
    }

    /**
     * @param string $password
     * @return bool
     */
    public static function isValidPassword(string $password)
    {
        if (strlen($password) < 6 || strlen($password) > 30) {
            return false;
        }

        $matches = [];
        preg_match('/^[A-Za-z0-9_.-]*$/', $password, $matches);

        return (count($matches) > 0);
    }

    /**
     * @param string $fullname
     * @return bool
     */
    public static function isValidFullname(string $fullname)
    {
        if (strlen($fullname) < 2 || strlen($fullname) > 100) {
            return false;
        }

        $matches = [];
        preg_match('/^([А-Яа-яёЁ\-\s]+)$/ui', $fullname, $matches);

        return (count($matches) > 0);
    }

    /**
     * @param string $email
     * @return bool
     */
    public static function isValidEmail(string $email)
    {
        if (strlen($email) < 6 || strlen($email) > 30) {
            return false;
        }

        $matches = [];
        preg_match('/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email, $matches);

        return (count($matches) > 0);
    }
}
