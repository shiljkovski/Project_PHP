<?php
require_once "./autoload.php";
require_once "./classes/author.php";

$_SESSION['status'] = 'success';
$_SESSION['msgs'] = [];
if (isset($_GET['id'])) {
    Author::deleteAuthor($connectOBJ, $_GET['id']);
    header("Location: author.php?deleteComplete");
    die;
}

if ($_POST['id'] != '') {
    Author::updateAuthor($connectOBJ, $_POST['id'], $_POST['author'], $_POST['bio']);
    header("Location: author.php?updateSuccess");
    die;
}

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    header("Location: author.php?invalidrequest");
    die();
}

if (!isset($_POST['author']) || empty($_POST['author'])) {
    $_SESSION['status'] = 'error';
    array_push($_SESSION['msgs'], 'Author Name is required!');
}
if (!isset($_POST['bio']) || empty($_POST['bio'])) {
    $_SESSION['status'] = 'error';
    array_push($_SESSION['msgs'], 'Bio is required!');
}

if (strlen($_POST['bio']) < 20) {
    $_SESSION['status'] = 'error';
    array_push($_SESSION['msgs'], 'Bio must be atleast 20 characters long!');
}

$author = $_POST['author'];
$bio = $_POST['bio'];
$authorObj = new author($connectOBJ, $author, $bio);
if (author::checkauthor($connectOBJ, $author)) {
    $_SESSION['status'] = 'error';
    array_push($_SESSION['msgs'], 'author already exists!');
}
if ($_SESSION['status'] == 'error') {
    header("Location: author.php?error");
    die;
}


$authorObj->createAuthor();
header("Location: author.php?submitSuccess");