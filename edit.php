<?php

require_once './helpers.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['id']){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "UPDATE users SET name = '$username', email = '$email', password = '$password' WHERE id = $id";
        $result = db_query($sql);
        if($result){
            echo "User updated successfully";
        }else{
            echo "ERROR: user update failed";
        }
}

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && !empty($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = db_query($sql);
    if ($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);
    }else{
        redirect('dashboard.php');
    }
}else{
    redirect('/dashboard.php');
}
?>

<h1>Edit User <?= $user['name'] ?></h1>

<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
    <input type="hidden" name="id" value="<?= $user['id']??'' ?>">
    <label for="username">Username</label> <br>
    <input type="text" name="username" value="<?= $user['name']??'' ?>"/> <br>

    <label for="email">email</label> <br>
    <input type="email" name="email" value="<?= $user['email']??'' ?>" /> <br>

    <label for="password">New Password</label> <br>
    <input type="password" name="password" /> <br>
    <button type="submit">
        update
    </button>
</form>