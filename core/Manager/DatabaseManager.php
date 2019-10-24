<?php
namespace Core\Manager;

use Core\Entity\User;

class DatabaseManager
{
    private $connection;

    public function __construct()
    {
        $host = "localhost";
        $database = "reg_form_project";
        $user = "root";
        $password = "root123";

        /*$this->connection = \mysqli_connect($host, $user, $password, $database);
        if ($this->connection->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->connection->connect_errno . ") " . $this->connection->connect_error;
        }
        $this->connection->set_charset("utf8");*/
        $dsn = "mysql:host=localhost;dbname=reg_form_project";
        $user = "root";
        $passwd = "root123";
        $options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );

        $this->connection = new \PDO($dsn, $user, $passwd, $options);
    }

    /**
     * Добавление дисциплины
     *
     * @param User $user
     * @return boolean
     */
    public function addUser(User $user)
    {
        $stm = $this->connection->prepare("INSERT INTO user (username, password, email, fullname) VALUES (:username, :password, :email, :fullname)");
        $stm->bindValue(":username", $user->getUsername());
        $stm->bindValue(":password", $user->getFullname());
        $stm->bindValue(":email", $user->getEmail());
        $stm->bindValue(":fullname", $user->getFullname());
        $stm->execute();
    }

    public function getUserControlInfo($login)
    {
        $stm = $pdo->prepare("SELECT * FROM countries WHERE id = ?");
        $stm->bindValue(1, $id);
        $stm->execute();

        $row = $stm->fetch(PDO::FETCH_ASSOC);
    }
}