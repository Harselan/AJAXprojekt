<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ajaxcomments";
$success = 0;
if(!(isset($_POST['name'])) || !(isset($_POST['password'])) || !(isset($_POST['passrepeat']))){
    $_SESSION['message'] = "Skriv in allt tack!";
    header("Location: ../index.php");
}else{
    $success ++;
}
$conn = mysqli_connect($servername, $username, $password, $dbname);
$_POST['name'] = mysqli_real_escape_string($conn, $_POST['name']);
$_POST['password'] = mysqli_real_escape_string($conn, $_POST['password']);
$_POST['passrepeat'] = mysqli_real_escape_string($conn, $_POST['passrepeat']);

$result = mysqli_query($conn,"SELECT ID FROM accounts WHERE NAME = '".$_POST['name']."'");
$row = mysqli_fetch_object($result);
if($row != null){
    $_SESSION['message'] = "Användarnamnet existerar redan";
    header("Location: ../index.php");
}else{
    $success ++;
}
if($_POST['password'] != $_POST['passrepeat']){
    $_SESSION['message'] = "Lösenorden stämde inte";
    header("Location: ../index.php");
}else{
    $success ++;
}
if($success == 3){
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $regg = mysqli_query($conn,"INSERT INTO accounts (NAME, PASSWORD) VALUES('".$_POST['name']."','".$_POST['password']."')");
    $_SESSION['message'] = "Ditt konto har nu regristrerats!";
    header('Location: ../index.php');
}
?>