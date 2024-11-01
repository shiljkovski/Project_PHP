<?php
require_once "./autoload.php";
?>


<div class="container">
    <form action="login.php" method="POST"
        class="position-absolute top-50 start-50 translate-middle text-center form-bg p-4 border border-dark rounded shadow-lg p-3 mb-5">
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
                echo "<p class='bg-danger bg-gradient'>$value<p>";
            }
        } ?>
        <button type="submit" class="btn btn-primary mt-4">Login</button>
        <p>Do not have an account? <a href="register-form.php">Register Here</a></p>
    </form>
</div>






</body>

</html>
<?php
session_destroy();
?>