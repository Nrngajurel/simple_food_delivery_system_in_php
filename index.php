<H1>User Login Registration System</H1>
<?php
require_once './helpers.php';

if(!is_logged_in()){

    ?>
        <a href="/login.php">Login</a> <br>
        <a href="/register.php">Register</a>
    <?php
}
else{
    ?>
        <a href="/dashboard.php">Dashboard</a> <br>
        <a href="/logout.php">Logout</a>

    <?php
}
?>