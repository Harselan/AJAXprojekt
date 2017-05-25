<?php
session_start();

if(!(isset($_SESSION['name'])) || !(isset($_SESSION['password']))){   
    if(isset($_POST['name']) && isset($_POST['password'])){
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['password'] = $_POST['password'];
    }else{
        $_SESSION['message'] = "Skriv in allt tack";
        $_SESSION['name'] = null;
        $_SESSION['password'] = null;
        header("Location: index.php");
        return;
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
}else{
    $_SESSION['message'] = "Användarnamnet finns inte";
    $_SESSION['name'] = null;
    $_SESSION['password'] = null;
    header("Location: index.php");
    return;
}
$passcheck = password_verify($_SESSION['password'], $password);
if(!$passcheck){
    $_SESSION['name'] = null;
    $_SESSION['password'] = null;
    $_SESSION['message'] = "Lösenordet är fel";
    header("Location: index.php");
    return;
}
?>
<html>
    <head>
        <script src="jquery-3.2.1.js"></script>
        <script src="scripts/script.js"></script>
        <link rel="stylesheet" href="styles/css.css">
        <meta charset="utf-8">
        <title>Ajaxkommentarer</title>
    </head>
    <body>
        <div class="wrapper">
            <h1 class="title">Harcom</h1>
            <div class="head">
                <h2>Välkommen<?php echo " " . $_SESSION['name'];?></h2><br>
                <a href='kontohantering/utloggning.php' class="submit" id="logout">Logga ut</a>
            </div>
            <div class="commentdiv"></div>
            <div class="commentadd">
                <h1>Lämna en kommentar</h1>
                <form id="form">
                    <input type="hidden" name="name" value="<?php echo $_SESSION['name'];?>">
                    Kommentar:<br><textarea name="comment" class="inputtext"></textarea><br>
                    <input type="submit" value="kommentera" class="submit"/>
                </form>
            </div>
        </div>
    </body>    
</html>