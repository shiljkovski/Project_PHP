<?php
require_once "./autoload.php";
require_once "./classes/Books.php";

$_SESSION['status'] = 'success';
$_SESSION['msgs'] = [];
if (isset($_GET['id'])) {
    Book::deleteBook($connectOBJ, $_GET['id']);
    header("Location: book.php?deleteComplete");
    die;
}


if ($_POST['id'] != '') {
    Book::updateBook($connectOBJ, $_POST['id'], $_POST['title'], $_POST['author'], $_POST['releaseYear'], $_POST['pagenum'], $_POST['img'], $_POST['category']);
    header("Location: book.php?updateSuccess");
    die;
}


if ($_SERVER['REQUEST_METHOD'] === "GET") {
    header("Location: book.php?invalidrequest");
    die();
}

if (!isset($_POST['title']) || empty($_POST['title'])) {
    $_SESSION['status'] = 'error';
    array_push($_SESSION['msgs'], 'Title is required!');
}

if (!isset($_POST['author']) || empty($_POST['author'])) {
    $_SESSION['status'] = 'error';
    array_push($_SESSION['msgs'], 'Author Name is required!');
}

if (!isset($_POST['releaseYear']) || empty($_POST['releaseYear'])) {
    $_SESSION['status'] = 'error';
    array_push($_SESSION['msgs'], 'Release Year is required!');
}

if (!isset($_POST['pagenum']) || empty($_POST['pagenum'])) {
    $_SESSION['status'] = 'error';
    array_push($_SESSION['msgs'], 'Page Numbers is required!');
}

if (!isset($_POST['img']) || empty($_POST['img'])) {
    $_SESSION['status'] = 'error';
    array_push($_SESSION['msgs'], 'Img url is required!');
}

if (!isset($_POST['category']) || empty($_POST['category'])) {
    $_SESSION['status'] = 'error';
    array_push($_SESSION['msgs'], 'Category is required!');
}


$title = $_POST['title'];
$author = $_POST['author'];
$releaseYear = $_POST['releaseYear'];
$pageNumber = $_POST['pagenum'];
$img = $_POST['img'];
$category = $_POST['category'];


$bookObj = new Book($connectOBJ, $title, $author, $releaseYear, $pageNumber, $img, $category);
if (Book::checkBook($connectOBJ, $title)) {
    $_SESSION['status'] = 'error';
    array_push($_SESSION['msgs'], 'Book already exists!');
}
if ($_SESSION['status'] == 'error') {
    header("Location: book.php?error");
    die;
}


$bookObj->createBook();
header("Location: book.php?submitSuccess");