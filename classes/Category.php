<?php


class Category
{
    private $categoryname;
    private $dbObj;


    public function __construct($dbObj, $categoryname)
    {
        $this->setDbObj($dbObj);
        $this->setCategoryname($categoryname);

    }

    /**
     * Get the value of categoryname
     */
    public function getCategoryname()
    {
        return $this->categoryname;
    }

    /**
     * Set the value of categoryname
     *
     * @return  self
     */
    public function setCategoryname($categoryname)
    {
        $this->categoryname = $categoryname;

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

    public static function checkCategory($dbObj, $category)
    {
        $sql = "SELECT * FROM category WHERE categoryname = :category";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":category", $category, PDO::PARAM_STR);
        $pdo_statement->execute();
        $count = $pdo_statement->fetchColumn();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function createCategory()
    {
        $dbObj = $this->getDbObj();
        $categoryName = $this->getCategoryname();
        $sql = "INSERT INTO category (categoryname) VALUES (:category)";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(':category', $categoryName, PDO::PARAM_STR);
        $pdo_statement->execute();

    }

    public function getAllCategories()
    {
        $dbObj = $this->getDbObj();
        $sql = "SELECT * FROM category";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->execute();
        $allCategories = [];
        while ($category = $pdo_statement->fetch(PDO::FETCH_ASSOC)) {
            array_push($allCategories, $category);
        }
        return $allCategories;


    }

    public function getUndeletedCategories()
    {
        $dbObj = $this->getDbObj();
        $sql = "SELECT * FROM category WHERE is_deleted = 0";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->execute();
        $allCategories = [];
        while ($category = $pdo_statement->fetch(PDO::FETCH_ASSOC)) {
            array_push($allCategories, $category);
        }
        return $allCategories;


    }
    public static function deleteCategory($dbObj, $id)
    {
        $sql = "UPDATE Category SET is_deleted = TRUE WHERE id =:id";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":id", $id, PDO::PARAM_INT);
        $pdo_statement->execute();

    }
    public static function updateCategory($dbObj, $id, $cateogry)
    {
        $sql = "UPDATE category SET categoryname = :category, is_deleted = 0 WHERE id = :id";
        $pdo_statement = $dbObj->prepare($sql);
        $pdo_statement->bindParam(":id", $id, PDO::PARAM_INT);
        $pdo_statement->bindParam(":category", $cateogry, PDO::PARAM_STR);
        $pdo_statement->execute();

    }


}