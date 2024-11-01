<?php


class Note
{
    private $note;
    private $user;
    private $book;
    private $dbObj;


    public function __construct($dbObj, $note, $user, $book)
    {
        $this->setDbObj($dbObj);
        $this->setNote($note);
        $this->setUser($user);
        $this->setBook($book);

    }

    /**
     * Get the value of note
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */
    public function setNote($note)
    {
        $this->note = $note;

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


    public function createNote()
    {
        $dbObj = $this->getDbObj();
        $note = $this->getNote();
        $user = $this->getUser();
        $book = $this->getBook();
        $sql = "INSERT INTO note (book_id, user_id, content) VALUES (:book, :user, :note)";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(':book', $book, PDO::PARAM_INT);
        $pdo_statement->bindParam(':user', $user, PDO::PARAM_INT);
        $pdo_statement->bindParam(':note', $note, PDO::PARAM_STR);
        $pdo_statement->execute();


    }


    public function getAllNotes($userId, $bookId)
    {
        $dbObj = $this->getDbObj();
        $sql = "SELECT 
                    n.id AS note_id,
                    n.content AS note,
                    u.id AS user_id,
                    u.username AS user,
                    b.id AS book_id,
                    b.booktitle AS book
                FROM 
                    note n
                JOIN 
                    user u ON n.user_id = u.id 
                JOIN 
                    book b ON n.book_id = b.id
                    WHERE u.id = :user_id
                    AND b.id = :book_id ";

        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $pdo_statement->bindParam(':book_id', $bookId, PDO::PARAM_INT);
        $pdo_statement->execute();
        $notes = [];
        while ($note = $pdo_statement->fetch(PDO::FETCH_ASSOC)) {
            array_push($notes, $note);
        }
        return $notes;


    }


    public static function deletenote($dbObj, $note_id)
    {
        $sql = "DELETE FROM note WHERE id =:id";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":id", $note_id, PDO::PARAM_INT);
        $pdo_statement->execute();

    }
    public static function updateNote($dbObj, $note_id, $note)
    {
        $sql = "UPDATE note SET content = :content WHERE id = :note_id";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":note_id", $note_id, PDO::PARAM_INT);
        $pdo_statement->bindParam(":content", $note, PDO::PARAM_STR);
        $pdo_statement->execute();

    }





}