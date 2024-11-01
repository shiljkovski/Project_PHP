<?php
require_once "./autoload.php";
require_once "./classes/Category.php";
if (!isset($_SESSION['admin'])) {
    header("Location: index.php?accessDenied");
    die;
}
$categoryObj = new Category($connectOBJ, "");
$allCategories = $categoryObj->getAllCategories();
?>

<div class="container mt-5 p-3 form-bg rounded">
    <form action="category-process.php" method="POST" class="bg-gradient p-4 border border-dark rounded shadow-lg p-3">
        <label for="category" class="h3">Category Details</label>
        <div class="input-group">
            <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
            <input type="text" class="form-control" id="category" name="category" placeholder="Enter category name"
                value="<?php echo isset($_GET['id']) ? $_GET['categoryname'] : ''; ?>">
            <?php if (isset($_GET['id'])): ?>
                <button type="submit" class="btn btn-primary ms-1">Update Category</button>
                <a href="categories.php" class="btn btn-secondary ms-1">Add New Category</a>
            <?php else: ?>
                <button type="submit" class="btn btn-primary ms-1">Add New Category</button>
            <?php endif; ?>
        </div>
        <?php if (isset($_SESSION['msgs'])) {
            foreach ($_SESSION['msgs'] as $value) {
                echo "<hr><p class='bg-danger bg-gradient'>$value<p>";
            }
        } ?>
    </form>

    <hr>
    <p class="h4">Manage Categories</p>
    <table class="table mt-3 ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category</th>
                <th scope="col">Deleted</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($allCategories as $value):
                    ?>
                    <td><?php echo $value['id'] ?></td>
                    <td><?php echo $value['categoryname'] ?></td>
                    <td><?php if ($value['is_deleted']) {
                        echo "Deleted";
                    } else {
                        echo "Not Deleted";
                    } ?></td>
                    <td>
                        <a href="categories.php?id=<?php echo $value['id']; ?>&categoryname=<?php echo $value['categoryname'] ?>"
                            class="btn btn-warning btn-sm">Edit</a>
                        <a href="category-process.php?id=<?php echo $value['id']; ?>"
                            class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            </tbody>
        <?php endforeach ?>
    </table>





</div>

<?php
require_once "./footer.php";
if (isset($_SESSION['status'])) {
    unset($_SESSION['status']);
}
if (isset($_SESSION['msgs'])) {
    unset($_SESSION['msgs']);
}