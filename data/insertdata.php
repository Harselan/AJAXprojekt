<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ajaxcomments";

$conn = mysqli_connect($servername,$username,$password,$dbname);
$name = $_POST['name'];
$comment = $_POST['comment'];
if($name == "" || $comment == ""){
    die("Skriv in allt tack!");
}
mysqli_query($conn, "INSERT INTO comments (NAME, COMMENT) VALUES ('$name','$comment')");
mysql_close($conn);
?>