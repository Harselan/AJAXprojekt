<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";

$conn = mysqli_connect($servername,$username,$password,$dbname);
$resultat;
header('Content-type: application/json');
$result = mysqli_query($conn, "SELECT * FROM tabeller");

if(!(mysqli_query($conn, "SELECT * FROM tabeller"))){
    echo mysqli_error($conn);
}
while($row = mysqli_fetch_object($result)){
    echo json_encode($row);
}
?>