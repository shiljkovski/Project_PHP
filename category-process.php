<?php
require_once "./autoload.php";
require_once "./classes/Category.php";

$_SESSION['status'] = 'success';
$_SESSION['msgs'] = [];
if (isset($_GET['id'])) {
    Category::deleteCategory($connectOBJ, $_GET['id']);
    header("Location: categories.php?deleteComplete");
    die;
}

if ($_POST['id'] != '') {
    category::updateCategory($connectOBJ, $_POST['id'], $_POST['category']);
    header("Location: categories.php?updateSuccess");
    die;
}

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    header("Location: categories.php?invalidrequest");
    die();
}

if (!isset($_POST['category']) || empty($_POST['category'])) {
    $_SESSION['status'] = 'error';
    array_push($_SESSION['msgs'], 'Category is required!');
}

$category = $_POST['category'];
$categoryObj = new Category($connectOBJ, $category);
if (Category::checkCategory($connectOBJ, $category)) {
    $_SESSION['status'] = 'error';
    array_push($_SESSION['msgs'], 'Category already exists!');
}
if ($_SESSION['status'] == 'error') {
    header("Location: categories.php?error");
    die;
}


$categoryObj->createCategory();
header("Location: categories.php?submitSuccess");