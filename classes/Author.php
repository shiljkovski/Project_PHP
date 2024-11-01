<?php


class Author
{
    private $authorName;
    private $biography;
    private $dbObj;


    public function __construct($dbObj, $authorName, $biography)
    {
        $this->setDbObj($dbObj);
        $this->setAuthorName($authorName);
        $this->setBiography($biography);

    }

    /**
     * Get the value of authorName
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * Set the value of authorName
     *
     * @return  self
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;

        return $this;
    }

    /**
     * Get the value of biography
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Set the value of biography
     *
     * @return  self
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

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

    public static function checkAuthor($dbObj, $author)
    {
        $sql = "SELECT * FROM author WHERE authorname = :author";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":author", $author, PDO::PARAM_STR);
        $pdo_statement->execute();
        $count = $pdo_statement->fetchColumn();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function createAuthor()
    {
        $dbObj = $this->getDbObj();
        $authorName = $this->getauthorname();
        $biography = $this->getBiography();
        $sql = "INSERT INTO author (authorname, shortbiography) VALUES (:author, :bio)";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(':author', $authorName, PDO::PARAM_STR);
        $pdo_statement->bindParam(':bio', $biography, PDO::PARAM_STR);
        $pdo_statement->execute();

    }

    public function getAllAuthor()
    {
        $dbObj = $this->getDbObj();
        $sql = "SELECT * FROM author";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->execute();
        $allAuthors = [];
        while ($author = $pdo_statement->fetch(PDO::FETCH_ASSOC)) {
            array_push($allAuthors, $author);
        }
        return $allAuthors;


    }
    public function getUndeletedAuthor()
    {
        $dbObj = $this->getDbObj();
        $sql = "SELECT * FROM author WHERE is_deleted = 0";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->execute();
        $allAuthors = [];
        while ($author = $pdo_statement->fetch(PDO::FETCH_ASSOC)) {
            array_push($allAuthors, $author);
        }
        return $allAuthors;


    }
    public static function deleteAuthor($dbObj, $id)
    {
        $sql = "UPDATE author SET is_deleted = TRUE WHERE id =:id";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":id", $id, PDO::PARAM_INT);
        $pdo_statement->execute();

    }
    public static function updateAuthor($dbObj, $id, $authorname, $biography)
    {
        $sql = "UPDATE author SET authorname = :author, shortbiography = :bio, is_deleted = 0 WHERE id = :id";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":id", $id, PDO::PARAM_INT);
        $pdo_statement->bindParam(":author", $authorname, PDO::PARAM_STR);
        $pdo_statement->bindParam(":bio", $biography, PDO::PARAM_STR);
        $pdo_statement->execute();

    }






}