<?php
namespace Core\Entity;

class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     */
    private $fullname;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $avatar;

    public function __construct()
    {
        $this->id = null;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $salt
     * @return $this
     */
    public function setSalt(string $salt)
    {
        $this->salt = $salt;
        return $this;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $fullname
     * @return $this
     */
    public function setFullname(string $fullname)
    {
        $this->fullname = $fullname;
        return $this;
    }

    /**
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * @param string $avatar
     * @return $this
     */
    public function setAvatar(string $avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param array $userArray
     */
    public function makeFromArray(array $userArray)
    {
        $this->id = $userArray["id"];

        $this->setUsername($userArray["username"]);
        $this->setEmail($userArray["email"]);
        $this->setFullname($userArray["fullname"]);
        $this->setAvatar($userArray["avatar"]);
    }

    /**
     * @param array $sessionInfo
     */
    public function loadFromSession($sessionInfo)
    {
        $this->id = $sessionInfo["id"];

        $this->setUsername($sessionInfo["username"]);
        $this->setEmail($sessionInfo["email"]);
        $this->setFullname($sessionInfo["fullname"]);
        $this->setAvatar($sessionInfo["avatar"]);
    }
}
