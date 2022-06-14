<?php

define('APP_NAME', 'Food Menu');

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
    redirect('/admin');
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
        redirect('/admin/login.php');
    }
}
function guest_check(){
    if(is_logged_in()){
        redirect('/admin');
    }
}

function get_image_link($image){
    return "http://". $_SERVER['HTTP_HOST'].$image;
}


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



function save_image($file){
    $target_dir = '/uploads/';
    $target_file = __DIR__.$target_dir . time().basename($file['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $error='';
    $success='';
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $error = "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $error = "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($file["size"] > 500000) {
        $error = "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            // echo "The file ". basename( $file["name"]). " has been uploaded.";
        } else {
            $error = "Sorry, there was an error uploading your file.";
        }
    }
    return [
        'error' => $error,
        'path' => str_replace(__DIR__, '', $target_file),
    ];
}


// frontend support functions

function get_header(){
    require_once('frontend/layouts/header.php');
}
function get_footer(){
    require_once 'frontend/layouts/footer.php';
}


// backend support functions
function get_admin_header(){
    require_once('admin/layouts/header.php');
    // echo $header;
}
function get_admin_footer(){
    $footer = require_once('admin/layouts/footer.php');
    echo $footer;
}

function get_admin_sidebar(){
    $sidebar = require_once('admin/layouts/sidebar.php');
    echo $sidebar;
}



// html helper

class FormHelper{

    public static function open_form($action, $method = 'post', $class = '', $id = ''){
        echo '<form action="' . $action . '" method="' . $method . '" class="'.$class.'" enctype="multipart/form-data">';
    }
    public static function close_form(){
        echo '</form>';
    }
    public static function label($name, $text){
        echo '<label for="' . $name . '">' . $text . '</label>';
    }

    public static function input($name,$placeholder ='', $value = '', $type = 'text', $class = 'w-full bg-gray-100 p-4 mb-5 pr-12 text-sm border-gray-200 rounded-lg shadow-sm', $id = ''){
        $html = '<input type="' . $type . '" name="' . $name . '" value="' . $value . '" class="' . $class . '" id="' . $id . '" placeholder="'.$placeholder.'">';
        echo $html;
    }

    // text area
    public static function textarea($name, $value = '', $class = 'w-full bg-gray-100 p-4 pr-12 text-sm border-gray-200 mb-5 rounded-lg shadow-sm', $id = ''){
        $html = '<textarea name="' . $name . '" class="' . $class . '" id="' . $id . '">' . $value . '</textarea>';
        echo $html;
    }

    // image upload
    public static function image_upload($name, $class = 'w-full bg-gray-100 p-4 pr-12 text-sm border-gray-200 mb-5 rounded-lg shadow-sm', $id = ''){
        $html = '<input type="file" name="' . $name . '" class="' . $class . '" id="' . $name . '">';
        echo $html;
    }
    public static function select($name, $options,$key,$value, $class = 'w-full bg-gray-100 p-4 pr-12 text-sm border-gray-200 mb-5 rounded-lg shadow-sm', $id = ''){
        $html = '<select name="' . $name . '" class="' . $class . '" id="' . $id . '">';
        $html.= '<option value="">Select Category</option>';
        foreach($options as  $option){
            $html .= '<option value="' . $option[$key] . '">' . $option[$value] . '</option>';
        }
        $html .= '</select>';
        echo $html;
    }

    public static function submit($name, $value = 'Submit', $class = 'p-4 pr-12 text-sm border-gray-200 rounded-lg shadow-sm bg-green-700 text-white', $id = ''){
        $html = '<button type="submit" name="' . $name . '" value="' . $value . '" class="' . $class . '" id="' . $id . '">' . $value . '</button>';
        echo $html;
    }
}