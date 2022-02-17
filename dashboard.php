<?php

require_once './helpers.php';

auth_check();

if(isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $delete_query = "DELETE FROM `users` WHERE `id` = $delete_id";
    $delete_result = mysqli_query($connection, $delete_query);
    // dd($connection->affected_rows > 0);
    if($connection->affected_rows > 0) {
        echo "<p>User deleted successfully.</p>";
    }
}

$sql = "SELECT * FROM users";
$result = db_query($sql);

echo "Hi " . current_user()['name'];
echo '<br>';
echo 'we got your email: ' . current_user()['email'];
echo '<br/><a href="/logout.php">Logout</a>';
echo "<hr>";


echo "<div style='display:flex; justify-content: space-between; margin:20px 200px'>";
    echo  "<div>Name</div>";
    echo  "<div>Email</div>";
    echo "<div>Action </div>";
    echo "</div><hr>";
while($user = mysqli_fetch_assoc($result)){
    echo "<div style='display:flex; justify-content: space-between; margin:20px 200px'>";
    echo  "<div>" . $user['name'] . "</div>";
    echo  "<div>" . $user['email'] . "</div>";
    echo "<div><a href='/edit.php?id=" . $user['id'] . "'>Edit</a>&#8195; | &#8195;";
    echo "<a href='".$_SERVER['PHP_SELF']."?delete_id=" . $user['id'] . "'>Delete</a> </div>";
    echo "</div>";
}

