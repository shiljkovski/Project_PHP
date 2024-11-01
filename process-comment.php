<?php
require_once "./autoload.php";
require_once "./classes/Comments.php";


if ($_SERVER['REQUEST_METHOD'] === "GET") {
    header("Location: index.php?&invalidrequest");
    die();
}
$action = $_POST['action'];
$bookId = $_POST['book_id'];


if ($action == 'update' && isset($_POST['comment_id'], $_POST['comment'])) {
    $commentId = $_POST['comment_id'];
    $comment = $_POST['comment'];
    Comment::updateComment($connectOBJ, $commentId, $comment);
    header("Location: bookinfo.php?id=$bookId&updateSuccess");
} elseif ($action == 'delete' && isset($_POST['comment_id'])) {
    $commentId = $_POST['comment_id'];
    Comment::deleteComment($connectOBJ, $commentId);
    header("Location: bookinfo.php?id=$bookId&deleteSuccess");
} elseif ($action == 'post' && isset($_POST['new_comment'])) {
    $comment = $_POST['new_comment'];
    $userId = $_POST['user_id'];
    $newComment = new Comment($connectOBJ, $comment, $userId, $bookId);
    $newComment->createComment();
    header("Location: bookinfo.php?id=$bookId&commentCreated");
}