<?php
require_once "./autoload.php";
require_once "./classes/Books.php";
require_once "./classes/Comments.php";
require_once "./classes/Notes.php";

$bookId = $_GET['id'];
$book = Book::getSingleBook($connectOBJ, $bookId);
$userId = $_SESSION['user_id'];

$comment = Comment::getUserComment($connectOBJ, $userId, $bookId);

$commentsObj = new Comment($connectOBJ, "", "", "");
$allApprovedComments = $commentsObj->getAllApprovedComments($bookId);

?>
<div class="container mt-5 p-0 form-bg rounded">
    <div class="card form-bg shadow mb-4">
        <div class="row g-0">
            <div class="col-md-4 p-4">
                <img src="<?php echo $book['img']; ?>" class="img-fluid rounded-start" alt="Book Cover">
            </div>
            <div class="col-md-8">
                <div class="card-body px-3 px-sm-4">
                    <h5 class="card-title"><?php echo $book['booktitle']; ?></h5>
                    <p class="card-text"><strong>Release Year:</strong> <?php echo $book['releaseyear']; ?></p>
                    <p class="card-text"><strong>Pages:</strong> <?php echo $book['pagenum']; ?></p>
                    <p class="card-text"><strong>Category:</strong> <?php echo $book['category']; ?></p>
                    <p class="card-text"><strong>Author:</strong> <?php echo $book['author']; ?></p>
                    <p class="card-text"><strong>Author Biography:</strong> </p>
                    <p class="card-text text-muted"><?php echo $book['bio']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-8 mb-4">
            <h2>My Notes</h2>
            <form id="create-note-form">
                <div class="form-group">
                    <textarea class="form-control" id="new_note" name="new_note" rows="4"
                        placeholder="Enter your note here"></textarea>
                </div>
                <input type="submit" class="btn btn-success" name="action" value="Post note" />
                <input type="hidden" name="book_id" value="<?= $bookId; ?>">
                <input type="hidden" name="user_id" value="<?= $userId; ?>">
            </form>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row" id="notes-list">
    </div>
</div>
<hr>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-8 ">
            <h2>Comments</h2>
            <form method="POST" action="process-comment.php">
                <?php if ($comment): ?>
                    <div class="form-group">
                        <label for="comment" class="h4">Your Comment</label>
                        <textarea class="form-control" id="comment" name="comment"
                            rows="4"><?php echo $comment['comment']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="action" value="update">Update Comment</button>
                    <button type="submit" class="btn btn-danger" name="action" value="delete">Delete Comment</button>
                    <input type="hidden" name="book_id" value="<?= $bookId; ?>">
                    <input type="hidden" name="comment_id" value="<?= $comment['comment_id']; ?>">
                <?php else: ?>
                    <div class="form-group">
                        <label for="new_comment">New Comment</label>
                        <textarea class="form-control" id="new_comment" name="new_comment" rows="4"
                            placeholder="Enter your comment here"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" name="action" value="post">Post Comment</button>
                    <input type="hidden" name="book_id" value="<?= $bookId; ?>">
                    <input type="hidden" name="comment_id" value="<?= $comment['comment_id']; ?>">
                    <input type="hidden" name="user_id" value="<?= $userId; ?>">
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
<hr>
<div class="container mt-5">
    <h2>Approved Comments</h2>
    <hr>
    <div class="row mt-4">
        <div class="col-md-8">
            <?php foreach ($allApprovedComments as $comment): ?>
                <div class="card mb-3 form-bg">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo ucfirst($comment['user']); ?></h3>
                        <hr>
                        <p class="card-text h5"><?php echo $comment['comment']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        var bookId = parseInt(<?php echo json_encode($bookId); ?>);
        var userId = parseInt(<?php echo json_encode($userId); ?>);

        var serializedData = {
            book_id: bookId,
            user_id: userId,
            action: 'get'
        };

        $.ajax({
            url: "../process-notes.php",
            method: "GET",
            data: serializedData,
            success: function (response) {
                updateNotesList(response);
            },
            error: function (error) {
                console.error(error);
            },
        });

        $("#create-note-form").on('submit', handleFormSubmit);
        $(document).on('submit', '#update-delete-note-form', handleFormSubmit);

        function handleFormSubmit(e) {
            e.preventDefault();
            let $form = $(this);
            let submitValue = $form.find('input[type="submit"][name="action"]:focus').val();
            let action = getAction(submitValue);

            let serializedData = $form.serialize();
            serializedData += '&action=' + action;

            $.ajax({
                url: "../process-notes.php",
                method: "POST",
                data: serializedData,
                success: function (response) {
                    updateNotesList(response);
                },
                error: function (error) {
                    console.error(error);
                },
            });
        }

        function updateNotesList(notes) {
            let notesList = $("#notes-list");
            notesList.empty();
            notes.forEach(function (note) {
                let noteItem = ` 
                <div class="col-md-4  mb-4">
                    <form id="update-delete-note-form">
                        <div class="form-group">
                            <textarea class="form-control" id="note" name="note" rows="4"
                                placeholder="Enter your note here">${note.note}</textarea>
                        </div>
                        <input type="submit" class="btn btn-success" name="action" value="Update note" />
                        <input type="submit" class="btn btn-danger" name="action" value="Delete note" />
                        <input type="hidden" name="note_id" value="${note.note_id}">
                        <input type="hidden" name="book_id" value="<?= $bookId; ?>">
                        <input type="hidden" name="user_id" value="<?= $userId; ?>">
                    </form>
                </div>`;
                notesList.append(noteItem);
            });
        }

        function getAction(value) {
            if (value == "Post note") {
                return 'post'
            } else if (value == "Update note") {
                return 'update'
            } else {
                return 'delete'
            }
        }
    });


</script>