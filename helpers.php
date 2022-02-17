<?php
session_start();

$connection = db_connect();

function dd(){
    echo '<pre>';
    print_r(func_get_args());
    echo '</pre>';
    die;
}
function redirect($path){
    header('Location: ' . $path);
    die;
}
function login($user){
    $_SESSION['user'] = $user;
    redirect('/dashboard.php');
}
function is_logged_in(){
    return isset($_SESSION['user']);
}
function current_user(){
    return $_SESSION['user'];
}
function logout(){
    unset($_SESSION['user']);

    redirect('/');
}
function auth_check(){
    if(!is_logged_in()){
        redirect('./login.php');
    }
}
function guest_check(){
    if(is_logged_in()){
        redirect('./dashboard.php');
    }
}


//Database related functions


// database connection 

function db_connect(){
    global $connection;
    $connection = mysqli_connect('localhost', 'root', '', 'test');
    if(!$connection){
        die('Database connection failed');
    }
    return $connection;
}

function db_query($query){
    global $connection;
    $result = mysqli_query($connection, $query);
    if(!$result){
        die('Query failed');
    }
    return $result;
}






