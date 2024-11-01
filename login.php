<?php
require_once "./autoload.php";
require_once "./classes/Users.php";



if ($_SERVER['REQUEST_METHOD'] === "GET") {
    header("Location: login-form.php?invalidrequest");
    die();
}

$_SESSION['msgs'] = [];
$_SESSION['status'] = 'success';

if (!isset($_POST['username']) || empty($_POST['username'])) {
    $_SESSION['status'] = 'error';
    array_push($_SESSION['msgs'], 'Username is required!');
}



if (!isset($_POST['password']) || empty($_POST['password'])) {
    $_SESSION['status'] = 'error';
    array_push($_SESSION['msgs'], 'Password is required!');
}

$username = $_POST['username'];
$password = $_POST['password'];

$userDB = Users::auth($connectOBJ, $username, $password);

if ($userDB != null) {

$_SESSION['user_id'] = $userDB['id'];
$_SESSION['user'] = $userDB['username'];
$_SESSION['name'] = $userDB['firstname'];
if ($_SESSION['user']) {
    
    if ($userDB['is_admin']) {

        $_SESSION['admin'] = $userDB['is_admin'];
    }
    header("Location: index.php?loginsuccess");
    die();
} }
else {
    header("Location: login-form.php?wrongcredentials");
    $_SESSION['status'] = 'error';
    array_push($_SESSION['msgs'], 'The username or password is incorect!');
    unset($_SESSION['user']);
    die();
}

