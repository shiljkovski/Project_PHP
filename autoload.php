<?php
require_once "./Database/Connection.php";
require_once "./conobj.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@400;700&family=Open+Sans:wght@400;700&family=Lato:wght@400;700&family=Source+Sans+Pro:wght@400;700&display=swap"
        rel="stylesheet">
    <title>Index Page</title>
    <script src="https://kit.fontawesome.com/27a957b448.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-light bg-nav border-dark rounded shadow-lg">
        <div class="container-fluid ps-4 pe-4">
            <a class="navbar-brand " href="index.php"><img class="logo"
                    src="https://brainster.co/wp-content/uploads/2021/08/Brainster.co_.png" alt="logo"></a>
            <button class="navbar-toggler " type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-3" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link me-3 navbar-style  rounded-5 shadow-lg bg-gradient" aria-current="page"
                            href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown  border-dark border-3 rounded shadow-lg <?php if (!isset($_SESSION['admin'])) {
                        echo "d-none";
                    } ?>">
                        <a class="nav-link dropdown-toggle navbar-style rounded-5 bg-gradient" href="#"
                            id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin Tools
                        </a>
                        <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="book.php">Manage Books</a></li>
                            <li><a class="dropdown-item" href="author.php">Manage Authors</a></li>
                            <li><a class="dropdown-item" href="categories.php">Manage Categories</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="comments.php">Manage Comments</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex justify-content-around">
                    <a href="register-form.php" class="btn btn-primary me-2 <?php if (isset($_SESSION['user'])) {
                        echo "d-none";
                    } ?>">Register</a>
                    <a href="login-form.php" class="btn btn-primary <?php if (isset($_SESSION['user'])) {
                        echo "d-none";
                    } ?>">Login</a>
                    <a href="logout.php" class="btn btn-primary btn-danger <?php if (!isset($_SESSION['user'])) {
                        echo "d-none";
                    } ?>">Logout</a>
                </form>
            </div>
        </div>
    </nav>