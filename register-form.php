<?php
require_once "./autoload.php";
if (isset($_SESSION['user'])) {
    header("Location: index.php");
}
?>
<div class="container ">
    <form action="registration.php" method="POST"
        class="position-absolute top-50 start-50 translate-middle text-center form-bg p-4 border border-dark rounded shadow-lg p-3 mb-5">
        <div class="form-group">
            <label class="h4" for="name">First Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter FIrst Name">
        </div>
        <div class="form-group">
            <label class="h4" for="last name">Last name</label>
            <input type="text" class="form-control" id="last name" name="lastname" placeholder="Enter Last name">
        </div>
        <div class="form-group">
            <label class="h4" for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
        </div>
        <div class="form-group">
            <label class="h4 mt-4" for="password">Password</label>
            <input type="password" class="form-control mb-2" id="password" name="password" placeholder="Password">
        </div>
        <?php if (isset($_SESSION['msgs'])) {
            foreach ($_SESSION['msgs'] as $value) {
                echo "<p class='bg-danger bg-gradient p-1'>$value<p>";
            }
        } ?>
        <button type="submit" class="btn btn-primary mt-4">Register</button>
        <p>Already have an account?<a href="login-form.php">Login Here</a></p>
    </form>
</div>






</body>

</html>
<?php
session_destroy();
?>