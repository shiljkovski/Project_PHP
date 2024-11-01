<?php

class Connection
{
    private $dBType;
    private $host;
    private $dbName;
    private $password;
    private $username;
    private $connection;

    public function __construct($dBType, $host, $dbName, $username, $password)
    {
        $this->setDBType($dBType);
        $this->setHost($host);
        $this->setDbName($dbName);
        $this->setPassword($password);
        $this->setUsername($username);
    }

    public function connect()
    {
        $dbType = $this->getDBType();
        $host = $this->getHost();
        $dbName = $this->getDbName();
        $password = $this->getPassword();
        $username = $this->getUsername();

        try {
            $connection = new PDO("$dbType:host=$host;dbname=$dbName", $username, $password);
            $this->setConnection($connection);
        } catch (\PDOException $error) {
            echo $error->getMessage();
            die;
        }
    }

    /**
     * Get the value of host
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set the value of host
     *
     * @return  self
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get the value of dBType
     */
    public function getDBType()
    {
        return $this->dBType;
    }

    /**
     * Set the value of dBType
     *
     * @return  self
     */
    public function setDBType($dBType)
    {
        $this->dBType = $dBType;

        return $this;
    }

    /**
     * Get the value of dbName
     */
    public function getDbName()
    {
        return $this->dbName;
    }

    /**
     * Set the value of dbName
     *
     * @return  self
     */
    public function setDbName($dbName)
    {
        $this->dbName = $dbName;

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
     * Get the value of connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Set the value of connection
     *
     * @return  self
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;

        return $this;
    }
}