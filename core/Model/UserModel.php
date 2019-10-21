<?php
namespace Core\Model;

class UserModel
{
    public $id;

    public $username;

    public $password;

    public $fullname;

    public $email;

    public function __construct()
    {
        $this->id = null;
        $this->username = null;
        $this->password = null;
        $this->fullname = null;
        $this->email = null;
    }
}
