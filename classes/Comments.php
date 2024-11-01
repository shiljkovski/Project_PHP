<?php


class Comment
{
    private $comment;
    private $user;
    private $book;
    private $dbObj;


    public function __construct($dbObj, $comment, $user, $book)
    {
        $this->setDbObj($dbObj);
        $this->setComment($comment);
        $this->setUser($user);
        $this->setBook($book);

    }

    /**
     * Get the value of comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set the value of book
     *
     * @return  self
     */
    public function setBook($book)
    {
        $this->book = $book;

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


    public function createComment()
    {
        $dbObj = $this->getDbObj();
        $comment = $this->getComment();
        $user = $this->getUser();
        $book = $this->getBook();
        $sql = "INSERT INTO comment (book_id, user_id, content) VALUES (:book, :user, :comment)";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(':book', $book, PDO::PARAM_INT);
        $pdo_statement->bindParam(':user', $user, PDO::PARAM_INT);
        $pdo_statement->bindParam(':comment', $comment, PDO::PARAM_STR);
        $pdo_statement->execute();
    }

    public static function getUserComment($dbObj, $user_id, $book_Id)
    {
        $sql = "SELECT 
                    c.id AS comment_id,
                    c.content AS comment,
                    u.id AS user_id,
                    u.username AS user,
                    b.id AS book_id,
                    b.booktitle AS book
                FROM 
                    comment c
                JOIN 
                    user u ON c.user_id = u.id
                JOIN 
                    book b ON c.book_id = b.id
                WHERE 
                    u.id = :user_id
                    AND b.id = :book_id";

        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $pdo_statement->bindParam(':book_id', $book_Id, PDO::PARAM_INT);
        $pdo_statement->execute();
        $comment = $pdo_statement->fetch(PDO::FETCH_ASSOC);
        return $comment;


    }

    public function getAllPendingComments()
    {
        $dbObj = $this->getDbObj();
        $sql = "SELECT 
                    c.id AS comment_id,
                    c.content AS comment,
                    u.id AS user_id,
                    u.username AS user,
                    b.id AS book_id,
                    b.booktitle AS book
                FROM 
                    comment c
                JOIN 
                    user u ON c.user_id = u.id
                JOIN 
                    book b ON c.book_id = b.id
                WHERE 
                    c.status = 0;";

        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->execute();
        $pendingComments = [];
        while ($comment = $pdo_statement->fetch(PDO::FETCH_ASSOC)) {
            array_push($pendingComments, $comment);
        }
        return $pendingComments;


    }


    public function getAllApprovedComments($bookId)
    {
        $dbObj = $this->getDbObj();
        $sql = "SELECT 
                    c.id AS comment_id,
                    c.content AS comment,
                    u.id AS user_id,
                    u.username AS user,
                    b.id AS book_id,
                    b.booktitle AS book
                FROM 
                    comment c
                JOIN 
                    user u ON c.user_id = u.id
                JOIN 
                    book b ON c.book_id = b.id
                WHERE 
                    c.status = 1
                    AND b.id = :id";

        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(':id', $bookId, PDO::PARAM_INT);
        $pdo_statement->execute();
        $approvedComments = [];
        while ($comment = $pdo_statement->fetch(PDO::FETCH_ASSOC)) {
            array_push($approvedComments, $comment);
        }
        return $approvedComments;


    }

    public function getAllAdminApprovedComments()
    {
        $dbObj = $this->getDbObj();
        $sql = "SELECT 
                    c.id AS comment_id,
                    c.content AS comment,
                    u.id AS user_id,
                    u.username AS user,
                    b.id AS book_id,
                    b.booktitle AS book
                FROM 
                    comment c
                JOIN 
                    user u ON c.user_id = u.id
                JOIN 
                    book b ON c.book_id = b.id
                WHERE 
                    c.status = 1";

        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->execute();
        $approvedComments = [];
        while ($comment = $pdo_statement->fetch(PDO::FETCH_ASSOC)) {
            array_push($approvedComments, $comment);
        }
        return $approvedComments;


    }

    public function getAllDisaprovedComments()
    {
        $dbObj = $this->getDbObj();
        $sql = "SELECT 
                    c.id AS comment_id,
                    c.content AS comment,
                    u.id AS user_id,
                    u.username AS user,
                    b.id AS book_id,
                    b.booktitle AS book
                FROM 
                    comment c
                JOIN 
                    user u ON c.user_id = u.id
                JOIN 
                    book b ON c.book_id = b.id
                WHERE 
                    c.status = 2;";

        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->execute();
        $disaprovedComments = [];
        while ($comment = $pdo_statement->fetch(PDO::FETCH_ASSOC)) {
            array_push($disaprovedComments, $comment);
        }
        return $disaprovedComments;


    }

    public static function deleteComment($dbObj, $comment_id)
    {
        $sql = "DELETE FROM comment WHERE id =:id";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":id", $comment_id, PDO::PARAM_INT);
        $pdo_statement->execute();

    }
    public static function updateComment($dbObj, $comment_id, $comment)
    {
        $sql = "UPDATE comment SET content = :content , status = 0 WHERE id = :comment_id";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":comment_id", $comment_id, PDO::PARAM_INT);
        $pdo_statement->bindParam(":content", $comment, PDO::PARAM_STR);
        $pdo_statement->execute();

    }

    public static function approveComment($dbObj, $comment_id)
    {
        $sql = "UPDATE comment SET status = 1 WHERE id = :comment_id";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":comment_id", $comment_id, PDO::PARAM_INT);
        $pdo_statement->execute();

    }

    public static function disapproveComment($dbObj, $comment_id)
    {
        $sql = "UPDATE comment SET status = 2 WHERE id = :comment_id";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":comment_id", $comment_id, PDO::PARAM_INT);
        $pdo_statement->execute();

    }






}