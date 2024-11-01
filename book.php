<?php
require_once "./autoload.php";
require_once "./classes/Books.php";
require_once "./classes/Author.php";
require_once "./classes/Category.php";
if (!isset($_SESSION['admin'])) {
    header("Location: index.php?accessDenied");
    die;
}

$authorObj = new Author($connectOBJ, "", "");
$allAuthors = $authorObj->getUndeletedAuthor();

$categoryObj = new Category($connectOBJ, "");
$allCategories = $categoryObj->getUndeletedCategories();

$bookObj = new Book($connectOBJ, "", "", "", "", "", "");
$allBooks = $bookObj->getAllBooks();
?>

<div class="container mt-5 p-3 rounded form-bg">
    <form action="book-process.php" method="POST" class="bg-gradient p-4 border border-dark rounded shadow-lg p-3 ">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                    <label for="title" class="h5">Book Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Book Title"
                        value="<?php echo isset($_GET['id']) ? $_GET['booktitle'] : ''; ?>">
                </div>
                <div class="col-sm">
                    <label for="releaseYear" class="h5">Year Released</label>
                    <input type="number" class="form-control" id="releaseYear" name="releaseYear"
                        placeholder="Enter Year Released"
                        value="<?php echo isset($_GET['id']) ? $_GET['releaseyear'] : ''; ?>">
                </div>
                <div class="col-sm">
                    <label for="pagenum" class="h5">Page Number</label>
                    <input type="number" class="form-control" id="pagenum" name="pagenum"
                        placeholder="Enter Page Numbers"
                        value="<?php echo isset($_GET['id']) ? $_GET['pagenum'] : ''; ?>">
                </div>
                <div class="col-sm">
                    <label for="img" class="h5">Img URL</label>
                    <input type="text" class="form-control" id="img" name="img" placeholder="Enter Img Url"
                        value="<?php echo isset($_GET['id']) ? $_GET['img'] : ''; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm">
                <p class="h5">Select Author</label>
                    <select class="form-select" id="author" name="author" aria-label="Default select example">
                        <option selected value="<?php echo isset($_GET['id']) ? $_GET['author_id'] : ''; ?>">
                            <?php echo isset($_GET['id']) ? $_GET['author'] : ''; ?>
                        </option>
                        <?php foreach ($allAuthors as $value): ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['authorname'] ?></option>";
                        <?php endforeach ?>
                    </select>
            </div>
            <div class="col-sm">
                <p class="h5">Select Category</label>
                    <select class="form-select" id="category" name="category" aria-label="Default select example">
                        <option selected value="<?php echo isset($_GET['id']) ? $_GET['category_id'] : ''; ?>">
                            <?php echo isset($_GET['id']) ? $_GET['category'] : ''; ?>
                        </option>
                        <?php foreach ($allCategories as $value): ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['categoryname'] ?></option>";
                        <?php endforeach ?>
                    </select>
            </div>
            .<div class="mb-3">
                <?php if (isset($_GET['id'])): ?>
                    <button type="submit" class="btn btn-primary ms-1">Update Book</button>
                    <a href="book.php" class="btn btn-secondary ms-1">Add New Book</a>
                <?php else: ?>
                    <button type="submit" class="btn btn-primary ms-1">Add New Book</button>
                <?php endif; ?>
            </div>


        </div>

        <?php if (isset($_SESSION['msgs'])) {
            foreach ($_SESSION['msgs'] as $value) {
                echo "<hr><p class='bg-danger bg-gradient'>$value<p>";
            }
        } ?>


        <hr>
        <p class="h4">Manage Categories</p>
        <div class="table-responsive">
            <table class="table mt-3 text-center">
                <thead>
                    <tr>
                        <th scope="col" class="fixed-width">#</th>
                        <th scope="col" class="fixed-width">Title</th>
                        <th scope="col" class="fixed-width">Author</th>
                        <th scope="col" class="fixed-width">Year Released</th>
                        <th scope="col" class="fixed-width">Page Number</th>
                        <th scope="col" class="fixed-width">Img Url</th>
                        <th scope="col" class="fixed-width">Category</th>
                        <th scope="col" class="fixed-width">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($allBooks as $value):
                            ?>
                            <td class="fixed-width"><?php echo $value['id'] ?></td>
                            <td class="fixed-width"><?php echo $value['booktitle'] ?></td>
                            <td class="fixed-width"><?php echo $value['author'] ?></td>
                            <td class="fixed-width"><?php echo $value['releaseyear'] ?></td>
                            <td class="fixed-width"><?php echo $value['pagenum'] ?></td>
                            <td class="fixed-width"><?php echo $value['img'] ?></td>
                            <td class="fixed-width"><?php echo $value['category'] ?></td>
                            <td class="fixed-width">
                                <a href="book.php?id=<?php echo $value['id']; ?>&booktitle=<?php echo $value['booktitle'] ?>&releaseyear=<?php echo $value['releaseyear'] ?>&pagenum=<?php echo $value['pagenum'] ?>&img=<?php echo $value['img'] ?>&author=<?php echo $value['author']; ?>&author_id= <?php echo $value['author_id'] ?>&category=<?php echo $value['category']; ?>&category_id=<?php echo $value['category_id'] ?> "
                                    class="btn btn-warning btn-sm">Edit</a>
                                <a data-link="book-process.php?id=<?php echo $value['id']; ?>"
                                    class="btn btn-danger btn-sm delete-confirm">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach ?>
            </table>
        </div>
</div>

<script src="./scripts/delete-alert.js"></script>

<?php
require_once "./footer.php";
if (isset($_SESSION['status'])) {
    unset($_SESSION['status']);
}
if (isset($_SESSION['msgs'])) {
    unset($_SESSION['msgs']);
}