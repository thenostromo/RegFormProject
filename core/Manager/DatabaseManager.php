<?php
namespace Core\Manager;

use Core\Entity\User;
use Core\Model\UserModel;
use Core\Reader\ParameterManager;

class DatabaseManager
{
    private $connection;

    /**
     * @var ParameterManager
     */
    private $parameterManager;

    public function __construct()
    {
        $this->parameterManager = new ParameterManager();
        $this->createConnection();
    }

    private function createConnection()
    {
        $dsn = sprintf("%s:host=%s;dbname=%s",
            $this->parameterManager->parameters["db_type"],
            $this->parameterManager->parameters["db_host"],
            $this->parameterManager->parameters["db_name"]
        );
        $user = $this->parameterManager->parameters["db_user"];
        $passwd = $this->parameterManager->parameters["db_password"];
        $options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );

        $this->connection = new \PDO($dsn, $user, $passwd, $options);
    }

    /**
     * @param UserModel $userModel
     * @return boolean
     */
    public function createUser(UserModel $userModel)
    {
        $stm = $this->connection->prepare("INSERT INTO user (username, password, email, fullname, avatar) VALUES (:username, :password, :email, :fullname, :avatar)");
        $stm->bindValue(":username", $userModel->username);
        $stm->bindValue(":password", $userModel->password);
        $stm->bindValue(":email", $userModel->email);
        $stm->bindValue(":fullname", $userModel->fullname);
        $stm->bindValue(":avatar", $userModel->avatar);
        $stm->execute();

        return $stm->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param UserModel $userModel
     * @return boolean
     */
    public function isUserExist($userModel)
    {
        $stm = $this->connection->prepare("SELECT * FROM user WHERE username = :username OR email = :email");
        $stm->bindValue(":username", $userModel->username);
        $stm->bindValue(":email", $userModel->email);
        $stm->execute();

        return $stm->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param UserModel $userModel
     * @return boolean
     */
    public function getUserInfo($userModel)
    {
        $stm = $this->connection->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
        $stm->bindValue(":username", $userModel->username);
        $stm->bindValue(":password", $userModel->password);
        $stm->execute();

        return $stm->fetch(\PDO::FETCH_ASSOC);
    }
}