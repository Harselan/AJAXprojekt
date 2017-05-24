<?php
header('Content-type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ajaxcomments";

$conn = mysqli_connect($servername,$username,$password,$dbname);

$tempstring = "";
$result = mysqli_query($conn, "SELECT ID,NAME,COMMENT FROM comments");
while($row = mysqli_fetch_object($result)){
    $tempstring .= json_encode($row) . ",";
}
$tempstring = "[".$tempstring."]";
$tempstring = str_replace(",]","]",$tempstring);
echo json_encode($tempstring);
?>