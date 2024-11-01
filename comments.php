<?php
require_once "./autoload.php";
require_once "./classes/Comments.php";

if (!isset($_SESSION['admin'])) {
    header("Location: index.php?accessDenied");
    die;
}
$commentsObj = new Comment($connectOBJ, "", "", "");
$allPendingComments = $commentsObj->getAllPendingComments();
$allApprovedComments = $commentsObj->getAllAdminApprovedComments();
$allDisapprovedComments = $commentsObj->getAllDisaprovedComments();


?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3 g-3 category-btn">
            <div class="form-group">
                <input type="radio" id="pending" name="status" class="radio-input d-none" value="0" checked>
                <label for="pending" class="radio-label pointer bg-danger rounded-5">Pending</label>
            </div>
        </div>
        <div class="col-md-3 g-3 category-btn">
            <div class="form-group">
                <input type="radio" id="approved" name="status" class="radio-input d-none" value="1">
                <label for="approved" class="radio-label pointer bg-danger rounded-5">Approved</label>
            </div>
        </div>
        <div class="col-md-3 g-3 category-btn">
            <div class="form-group">
                <input type="radio" id="disapproved" name="status" class="radio-input d-none" value="2">
                <label for="disapproved" class="radio-label pointer bg-danger rounded-5">Disapproved</label>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="container mt-5 status-wrapper">
    <h2>Pending Comments</h2>
    <hr>
    <div class="row mt-4">
        <div class="col-md-8">
            <?php foreach ($allPendingComments as $comment): ?>
                <div class="card mb-3 form-bg">
                    <div class="card-body">
                        <h5 class="card-title">Comment #<?php echo $comment['comment_id']; ?></h5>
                        <p class="card-text">User: <?php echo $comment['user']; ?></p>
                        <p class="card-text">Book: <?php echo $comment['book']; ?></p>
                        <p class="card-text">Comment: <?php echo $comment['comment']; ?></p>
                        <form action="admin-comment.php" method="post">
                            <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>">
                            <div class="form-group">
                                <label for="editedComment<?php echo $comment['comment_id']; ?>">Edit Comment:</label>
                                <textarea class="form-control" id="editedComment<?php echo $comment['comment_id']; ?>"
                                    name="edited_comment" rows="3"><?php echo $comment['comment']; ?></textarea>
                            </div>
                            <div class="btn-group mt-3" role="group" aria-label="Comment Actions">
                                <button type="submit" name="edit" class="btn btn-success mr-2">Edit</button>
                                <button type="submit" name="approve" class="btn btn-primary mr-2">Approve</button>
                                <button type="submit" name="disapprove" class="btn btn-danger">Disapprove</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="container mt-5 d-none status-wrapper" id="approved">
    <h2>Approved Comments</h2>
    <hr>
    <div class="row mt-4">
        <div class="col-md-8">
            <?php foreach ($allApprovedComments as $comment): ?>
                <div class="card mb-3 form-bg">
                    <div class="card-body">
                        <h5 class="card-title">Comment #<?php echo $comment['comment_id']; ?></h5>
                        <p class="card-text">User: <?php echo $comment['user']; ?></p>
                        <p class="card-text">Book: <?php echo $comment['book']; ?></p>
                        <p class="card-text">Comment: <?php echo $comment['comment']; ?></p>
                        <form action="admin-comment.php" method="post">
                            <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>">
                            <div class="form-group">
                                <label for="editedComment<?php echo $comment['comment_id']; ?>">Edit Comment:</label>
                                <textarea class="form-control" id="editedComment<?php echo $comment['comment_id']; ?>"
                                    name="edited_comment" rows="3"><?php echo $comment['comment']; ?></textarea>
                            </div>
                            <div class="btn-group mt-3" role="group" aria-label="Comment Actions">
                                <button type="submit" name="edit" class="btn btn-success mr-2">Edit</button>
                                <button type="submit" name="disapprove" class="btn btn-danger">Disapprove</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="container mt-5 d-none status-wrapper" id="disapproved">
    <h2>Disapproved Comments</h2>
    <hr>
    <div class="row mt-4">
        <div class="col-md-8">
            <?php foreach ($allDisapprovedComments as $comment): ?>
                <div class="card mb-3 form-bg">
                    <div class="card-body">
                        <h5 class="card-title">Comment #<?php echo $comment['comment_id']; ?></h5>
                        <p class="card-text">User: <?php echo $comment['user']; ?></p>
                        <p class="card-text">Book: <?php echo $comment['book']; ?></p>
                        <p class="card-text">Comment: <?php echo $comment['comment']; ?></p>
                        <form action="admin-comment.php" method="post">
                            <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>">
                            <div class="form-group">
                                <label for="editedComment<?php echo $comment['comment_id']; ?>">Edit Comment:</label>
                                <textarea class="form-control" id="editedComment<?php echo $comment['comment_id']; ?>"
                                    name="edited_comment" rows="3"><?php echo $comment['comment']; ?></textarea>
                            </div>
                            <div class="btn-group mt-3" role="group" aria-label="Comment Actions">
                                <button type="submit" name="edit" class="btn btn-success mr-2">Edit</button>
                                <button type="submit" name="approve" class="btn btn-primary mr-2">Approve</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script src="./scripts/comments.js"></script>


<?php
require_once "./footer.php";
?>