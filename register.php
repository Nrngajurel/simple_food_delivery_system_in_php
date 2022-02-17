<?php

require_once './helpers.php';
guest_check();


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = "INSERT INTO users (name, email, password) VALUES ('$username', '$email', '$password')";
        $result = db_query($query);
        if($result){
            $sql = "SELECT * FROM users WHERE id = '$connection->insert_id'";
            $result = db_query($sql);
            $user = mysqli_fetch_assoc($result);
            login($user);
        }else{
            echo "ERROR: user registration failed";
        }

    }else{
        echo "ERROR: All Field are Required";
    }

}
   

?>

<h1>Registration Form</h1>


<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="username">Username</label> <br>
    <input type="text" name="username" /> <br>

    <label for="email">email</label> <br>
    <input type="email" name="email" /> <br>

    <label for="password">Password</label> <br>
    <input type="password" name="password" /> <br>
    <button type="submit">
        Register
    </button>
</form>