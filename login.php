<?php

include_once './helpers.php';
guest_check();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE name = '$username' AND password = '$password'";
            $result = db_query($sql);
            if($result->num_rows > 0){
                $user = mysqli_fetch_assoc($result);
                login($user);
            }
            else{
                echo "ERROR: Invalid username or password";
            }
    }else{
        echo "Username and Password required";
    }
}
?>

<h1>Login form</h1>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="username">Username</label> <br>
    <input type="text" name="username" /> <br>
    <label for="password">Password</label> <br>
    <input type="password" name="password" /> <br>
    <button type="submit">
        Login
    </button>
</form>

