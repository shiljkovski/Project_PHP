<?php


class Users
{
    private $firstname;
    private $lastname;
    private $username;
    private $password;
    private $dbObj;

    public function __construct($dbObj, $firstname, $lastname, $username, $password)
    {
        $this->setDbObj($dbObj);
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setUsername($username);
        $this->setPassword($password);
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }


    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of dbObj
     */
    public function getDbObj()
    {
        return $this->dbObj;
    }

    /**
     * Set the value of dbObj
     *
     * @return  self
     */
    public function setDbObj($dbObj)
    {
        $this->dbObj = $dbObj;

        return $this;
    }

    public static function checkUsername($dbObj, $username)
    {
        $sql = "SELECT * FROM user WHERE username = :username";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":username", $username, PDO::PARAM_STR);
        $pdo_statement->execute();
        $count = $pdo_statement->fetchColumn();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function addUser()
    {
        $dbObj = $this->getDbObj();
        $firstname = $this->getFirstname();
        $lastname = $this->getLastname();
        $username = $this->getUsername();
        $password = $this->getPassword();

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO user (firstname, lastname, username, password) VALUES (:firstname, :lastname, :username, :password)";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $pdo_statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $pdo_statement->bindParam(':username', $username, PDO::PARAM_STR);
        $pdo_statement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $pdo_statement->execute();
    }



    public static function auth($dbObj, $username, $password)
    {


        $sql = "SELECT * FROM user WHERE username = :username";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":username", $username, PDO::PARAM_STR);
        $pdo_statement->execute();
        $user = $pdo_statement->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $user['password'])) {
            return $user;
        } else {
            return null;
        }
    }





}