<?php
session_start();

if(isset($_SESSION['name']) && isset($_SESSION['password'])){
    
}else{
    if(isset($_POST['name']) && isset($_POST['password'])){
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['password'] = $_POST['password'];
    }else{
        $_SESSION['message'] = "Skriv in allt tack";
        $_SESSION['name'] = null;
        $_SESSION['password'] = null;
        header("Location: index.php");
    }
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ajaxcomments";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$decrypt = mysqli_query($conn, "SELECT PASSWORD FROM accounts WHERE NAME ='".$_SESSION['name']."'");
$row = mysqli_fetch_object($decrypt);
if($row != null){
    $password = $row->PASSWORD;
}
$passcheck = password_verify($_SESSION['password'], $password);
if(!$passcheck){
    $_SESSION['name'] = null;
    $_SESSION['password'] = null;
    $_SESSION['message'] = "Lösenordet är fel";
    header("Location: index.php");
}
?>
<html>
    <head>
        <script src="jquery-3.2.1.js"></script>
        <script src="scripts/script.js"></script>
        <meta charset="utf-8">
        <title>Ajaxkommentarer</title>
    </head>
    <body>
        <div class="wrapper">
        <h2>Välkommen<?php echo " " . $_SESSION['name'];?></h2>
        <h1>Lämna en kommentar</h1>
        <a href='kontohantering/utloggning.php'>Logga ut</a>
        <form id="form">
            <input type="hidden" name="name" value="<?php echo $_SESSION['name'];?>">
            Kommentar:<textarea name="comment" class="inputtext"></textarea><br><br>
            <input type="submit" value="kommentera"/>
        </form>
        </div>
    </body>    
</html>