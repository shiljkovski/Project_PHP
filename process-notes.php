<?php
require_once "./conobj.php";
require_once "./classes/Notes.php";


$action = $_POST['action'] ?? $_GET['action'];
$bookId = $_POST['book_id'] ?? $_GET['book_id'];
$userId = $_POST['user_id'] ?? $_GET['user_id'];


if ($action == 'update' && isset($_POST['note_id'], $_POST['note'])) {
    $noteId = $_POST['note_id'];
    $note = $_POST['note'];
    Note::updateNote($connectOBJ, $noteId, $note);
    $newNote = new note($connectOBJ, $note, $userId, $bookId);
    $allNotes = $newNote->getAllNotes($userId, $bookId);
    header('Content-Type: application/json');
    echo json_encode($allNotes);
} elseif ($action == 'delete' && isset($_POST['note_id'])) {
    $noteId = $_POST['note_id'];
    Note::deletenote($connectOBJ, $noteId);
    $newNote = new note($connectOBJ, "", $userId, $bookId);
    $allNotes = $newNote->getAllNotes($userId, $bookId);
    header('Content-Type: application/json');
    echo json_encode($allNotes);
} elseif ($action == 'post' && isset($_POST['new_note'])) {
    $note = $_POST['new_note'];
    $newNote = new note($connectOBJ, $note, $userId, $bookId);
    $newNote->createNote();
    $allNotes = $newNote->getAllNotes($userId, $bookId);

    header('Content-Type: application/json');
    echo json_encode($allNotes);
} else {
    $newNote = new note($connectOBJ, "", $userId, $bookId);
    $allNotes = $newNote->getAllNotes($userId, $bookId);
    header('Content-Type: application/json');
    echo json_encode($allNotes);
}
