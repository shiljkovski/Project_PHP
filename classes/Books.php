<?php


class Book
{
    private $bookTitle;
    private $author;
    private $yearReleased;
    private $numPages;
    private $img;
    private $category;
    private $dbObj;


    public function __construct($dbObj, $bookTitle, $author, $yearReleased, $pagenum, $img, $category)
    {
        $this->setDbObj($dbObj);
        $this->setBookTitle($bookTitle);
        $this->setAuthor($author);
        $this->setYearReleased($yearReleased);
        $this->setNumPages($pagenum);
        $this->setImg($img);
        $this->setcategory($category);

    }

    /**
     * Get the value of bookTitle
     */
    public function getBookTitle()
    {
        return $this->bookTitle;
    }

    /**
     * Set the value of bookTitle
     *
     * @return  self
     */
    public function setBookTitle($bookTitle)
    {
        $this->bookTitle = $bookTitle;

        return $this;
    }

    /**
     * Get the value of author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the value of yearReleased
     */
    public function getYearReleased()
    {
        return $this->yearReleased;
    }

    /**
     * Set the value of yearReleased
     *
     * @return  self
     */
    public function setYearReleased($yearReleased)
    {
        $this->yearReleased = $yearReleased;

        return $this;
    }

    /**
     * Get the value of numPages
     */
    public function getNumPages()
    {
        return $this->numPages;
    }

    /**
     * Set the value of numPages
     *
     * @return  self
     */
    public function setNumPages($numPages)
    {
        $this->numPages = $numPages;

        return $this;
    }

    /**
     * Get the value of img
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set the value of img
     *
     * @return  self
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */
    public function setCategory($category)
    {
        $this->category = $category;

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

    public static function checkBook($dbObj, $bookName)
    {
        $sql = "SELECT * FROM book WHERE booktitle = :name";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":name", $bookName, PDO::PARAM_STR);
        $pdo_statement->execute();
        $count = $pdo_statement->fetchColumn();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function createBook()
    {
        $dbObj = $this->getDbObj();
        $bookTitle = $this->getBookTitle();
        $author = $this->getAuthor();
        $yearReleased = $this->getyearReleased();
        $pagenum = $this->getNumPages();
        $img = $this->getimg();
        $category = $this->getcategory();

        $sql = "INSERT INTO book (booktitle, author_id, releaseyear, pagenum, img, category_id) VALUES (:booktitle, :author, :releaseyear, :pagenum, :img, :category)";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(':booktitle', $bookTitle, PDO::PARAM_STR);
        $pdo_statement->bindParam(':author', $author, PDO::PARAM_INT);
        $pdo_statement->bindParam(':releaseyear', $yearReleased, PDO::PARAM_INT);
        $pdo_statement->bindParam(':pagenum', $pagenum, PDO::PARAM_INT);
        $pdo_statement->bindParam(':img', $img, PDO::PARAM_STR);
        $pdo_statement->bindParam(':category', $category, PDO::PARAM_INT);
        $pdo_statement->execute();

    }

    public function getAllBooks()
    {
        $dbObj = $this->getDbObj();
        $sql = "SELECT 
        Book.id as id,
    Book.booktitle as booktitle,
    Author.authorname as author,
    Author.id as author_id,
    Book.releaseyear,
    Book.pagenum,
    Book.img,
    Category.categoryname as category,
    Category.id as category_id
FROM 
    Book
LEFT JOIN 
    Author ON Book.author_id = Author.id
LEFT JOIN 
    Category ON Book.category_id = Category.id;";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->execute();
        $allAuthors = [];
        while ($author = $pdo_statement->fetch(PDO::FETCH_ASSOC)) {
            array_push($allAuthors, $author);
        }
        return $allAuthors;


    }
    public static function getSingleBook($dbObj, $id)
    {
        $sql = "SELECT 
        Book.id as id,
    Book.booktitle as booktitle,
    Author.authorname as author,
    Author.shortbiography as bio,
    Book.releaseyear,
    Book.pagenum,
    Book.img,
    Category.categoryname as category
FROM 
    Book
LEFT JOIN 
    Author ON Book.author_id = Author.id
LEFT JOIN 
    Category ON Book.category_id = Category.id WHERE Book.id = :id;";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":id", $id, PDO::PARAM_INT);
        $pdo_statement->execute();
        $book = $pdo_statement->fetch(PDO::FETCH_ASSOC);
        return $book;

    }
    public static function deleteBook($dbObj, $id)
    {
        $sql = " DELETE FROM book  WHERE id =:id";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":id", $id, PDO::PARAM_INT);
        $pdo_statement->execute();

    }
    public static function updateBook($dbObj, $id, $bookTitle, $author, $yearReleased, $pageNum, $img, $category)
    {
        $sql = "UPDATE book SET booktitle = :booktitle, author_id = :author, releaseyear = :yearReleased, pagenum = :pagenumber, img = :img, category_id = :category WHERE id = :id";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":id", $id, PDO::PARAM_INT);
        $pdo_statement->bindParam(":booktitle", $bookTitle, PDO::PARAM_STR);
        $pdo_statement->bindParam(":author", $author, PDO::PARAM_INT);
        $pdo_statement->bindParam(":yearReleased", $yearReleased, PDO::PARAM_INT);
        $pdo_statement->bindParam(":pagenumber", $pageNum, PDO::PARAM_INT);
        $pdo_statement->bindParam(":img", $img, PDO::PARAM_STR);
        $pdo_statement->bindParam(":category", $category, PDO::PARAM_STR);
        $pdo_statement->execute();

    }








}