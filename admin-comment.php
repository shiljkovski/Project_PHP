<?php
require_once "./autoload.php";
require_once "./classes/Comments.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    header("Location: comments.php?&invalidrequest");
    die();
}

// Check which button was clicked
if (isset($_POST['edit'])) {
    $commentId = $_POST['comment_id'];
    $comment = $_POST['edited_comment'];
    Comment::updateComment($connectOBJ, $commentId, $comment);
    header("Location: comments.php?updateSuccess");
    die;
} elseif (isset($_POST['approve'])) {
    $commentId = $_POST['comment_id'];
    Comment::approveComment($connectOBJ, $commentId);
    header("Location: comments.php?ApproveSuccess");
    die;
} elseif (isset($_POST['disapprove'])) {
    $commentId = $_POST['comment_id'];
    Comment::disapproveComment($connectOBJ, $commentId);
    header("Location: comments.php?DisapproveSuccess");
    die;
}


?>