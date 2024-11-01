<?php
require_once "./autoload.php";
require_once "./classes/Books.php";
require_once "./classes/Category.php";


$categoryObj = new Category($connectOBJ, "");
$allCategories = $categoryObj->getUndeletedCategories();

$bookObj = new Book($connectOBJ, "", "", "", "", "", "");
$allBooks = $bookObj->getAllBooks();



?>
<div class="container banner">
    <h1 class="text-uppercase text-warning text-center">brainster library</h1>
</div>
<div class="container mb-5  bg-nav bg-gradient">
    <h2>Welcome <?php if (isset($_SESSION['name'])) {
        echo ucfirst($_SESSION['name']);
    } else {
        echo "Guest";
    } ?></h2>


    <h3 class="text-center mb-4 text-uppercase mt-5">Categories</h3>
    <div class="row  g-2">
        <hr>
        <?php
        foreach ($allCategories as $index => $category) {
            if ($index > 0 && $index % 6 == 0) {
                echo '</div><div class="row  g-2">';
            } else {
                echo '<div class="col-1"></div>';
            }
            ?>
            <div class="col-md-3 g-3  bg-danger bg-gradient text-center rounded-5 category-btn"
                id="<?php echo $category['id']; ?>">
                <div class="form-group">
                    <input type="checkbox" class="d-none" name="<?php echo $category['id']; ?>"
                        value="<?php $category['id'] ?>">
                    <label for="<?php echo $category['id']; ?>"
                        class="p-2 text-uppercase pointer"><?php echo $category['categoryname'] ?></label>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <hr>


    <h3 class="text-center mb-4 mt-5 text-uppercase">Books</h3>
    <div class="row">
        <?php foreach ($allBooks as $book): ?>
            <div class="book-card col-md-4 p-4" data-category-id="<?php echo $book['category_id']; ?>"
                data-book-id="<?php echo $book['id']; ?>">
                <div class="card form-bg mb-4">
                    <img src="<?php echo $book['img']; ?>" class="card-img-top" alt="Book Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $book['booktitle']; ?></h5>
                        <p class="card-text">Author: <?php echo $book['author']; ?></p>
                        <p class="card-text"><span class="text-muted text-decoration-underline">Category:
                                <?php echo $book['category']; ?></span></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</div>

<script src="./scripts/index.js"></script>
<?php
require_once "./footer.php";
?>