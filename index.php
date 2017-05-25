<?php
session_start();
if(isset($_SESSION['message']) && $_SESSION['message'] != null){
    echo "<h2>".$_SESSION['message']."</h2>";
    $_SESSION['message'] = null;
}
if (isset($_SESSION['name']) && isset($_SESSION['password'])){
    header('Location: kontosida.php');
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <link href="styles/css.css" rel="stylesheet">
        <title>Harcom</title>
    </head>
    <body>
        <div class="wrapper">
            <h1 class="title">Harcom</h1>
            <div class="header">
                <?php 
                echo "<form method='POST' action='kontosida.php' class='login'>
                <h2>Logga in</h2><br><br>
                <h3 class='inputname'>Namn:</h3><input type='text' name='name'><br><br>
                <h3 class='inputname'>Lösenord:</h3><input type='password' name='password'><br><br>
                <input type='submit' class='submit' value='Logga in'> 
                </form>";    
                ?>
            </div>
            <div class="footer">
                <?php
                echo "<form method='POST' action='kontohantering/register.php'>
                <h2>Regristrera konto</h2><br><br>
                <input type='text' name='name'><h3 class='inputname'>Namn:</h3><br>
                <input type='password' name='password'><h3 class='inputname'>Lösenord:</h3><br>
                <input type='password' name='passrepeat'><h3 class='inputname'>Repetera Lösenord:</h3><br><br>
                <input type='submit' class='submit' value='Regristrera'> 
                </form>"; 
                ?>
            </div>
        </div>
    </body>
</html>