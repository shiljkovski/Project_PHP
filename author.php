<?php
require_once "./autoload.php";
require_once "./classes/Author.php";
if (!isset($_SESSION['admin'])) {
    header("Location: index.php?accessDenied");
    die;
}

$authorObj = new Author($connectOBJ, "", "");
$allAuthors = $authorObj->getAllAuthor();
?>

<div class="container mt-5 p-3 form-bg rounded">
    <form action="author-process.php" method="POST" class="bg-gradient p-4 border border-dark rounded shadow-lg p-3">
        <p class="h3">Author Details</p>
        <label for="author" class="h5">Author Name</label>
        <div class="input-group">
            <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
            <input type="text" class="form-control" id="author" name="author" placeholder="Enter Author name"
                value="<?php echo isset($_GET['id']) ? $_GET['authorname'] : ''; ?>">
            <?php if (isset($_GET['id'])): ?>
                <button type="submit" class="btn btn-primary ms-1">Update Author</button>
                <a href="author.php" class="btn btn-secondary ms-1">Add New Author</a>
            <?php else: ?>
                <button type="submit" class="btn btn-primary ms-1">Add New Author</button>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="bio" class="h5">Author Biography</label>
            <textarea class="form-control" id="bio" name="bio" rows="3"
                placeholder="Write bio for the author(min 20 characters)"><?php echo isset($_GET['id']) ? $_GET['bio'] : ''; ?></textarea>
        </div>

        <?php if (isset($_SESSION['msgs'])) {
            foreach ($_SESSION['msgs'] as $value) {
                echo "<hr><p class='bg-danger bg-gradient'>$value<p>";
            }
        } ?>
    </form>

    <hr>
    <p class="h4">Manage Authors</p>
    <div class="table-responsive">
        <table class="table mt-3 text-center">
            <thead>
                <tr>
                    <th scope="col" class="fixed-width">#</th>
                    <th scope="col" class="fixed-width">Name</th>
                    <th scope="col" class="fixed-width">Biography</th>
                    <th scope="col" class="fixed-width">Deleted</th>
                    <th scope="col" class="fixed-width">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($allAuthors as $value):
                        ?>
                        <td class="fixed-width" class="fixed-width"><?php echo $value['id'] ?></td>
                        <td class="fixed-width"><?php echo $value['authorname'] ?></td>
                        <td class="fixed-width"><?php echo $value['shortbiography'] ?></td>
                        <td class="fixed-width"><?php if ($value['is_deleted']) {
                            echo "Deleted";
                        } else {
                            echo "Not Deleted";
                        } ?></td>
                        <td class="fixed-width">
                            <a href="author.php?id=<?php echo $value['id']; ?>&authorname=<?php echo $value['authorname'] ?> &bio=<?php echo $value['shortbiography'] ?>"
                                class="btn btn-warning btn-sm">Edit</a>
                            <a href="author-process.php?id=<?php echo $value['id']; ?>"
                                class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach ?>
        </table>
    </div>
</div>
<?php
require_once "./footer.php";

if (isset($_SESSION['status'])) {
    unset($_SESSION['status']);
}
if (isset($_SESSION['msgs'])) {
    unset($_SESSION['msgs']);
}
?>