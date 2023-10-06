<?php
session_start();
include_once "ErrorHandling.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" >
        <title>Login</title>
        <link href="reset.css" rel="stylesheet">
        <link href="login.css" rel="stylesheet">

    </head>
    <body>
        <header><h1>Login page</h1></header>
        <nav>
            <a id="link3" href="contact.php">contact</a>
            <a href="webshop.php">webshop</a>
            <a id="link1" href="index.php">home</a>
        </nav>
        <article>
            <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
            <input type="text" id="naam" name="naam" placeholder="name">
            <br>
            <br>
            <input type="password" id="password" name="password" placeholder="password">
            <br>
            <br>
            <input type="submit" id="knop" name="submit" value="login">
            <br>
            <br>
            <a href="register.php">register</a>
            </form>
        </article>
        <?php
        if(isset($_POST['submit']) && !empty($_POST['naam']) && !empty($_POST['password'])) {
            $name= htmlspecialchars($_POST['naam']);
            $pswd = htmlspecialchars($_POST['password']);

            $host = "localhost";
            $user = "Webusers";
            $password = "Lab2021";
            $database = "webshop";

            $link = mysqli_connect($host,$user,$password) or die("Error: No connection to the host");
            mysqli_select_db($link, $database) or die("Error: no database found");

            $quer = "Select * From tblgebruikers Where Naam = '$name'";
            $res = mysqli_query($link, $quer) or throw new Error("Error: executing query");
            $row = mysqli_fetch_assoc($res);
            $ammount =  mysqli_num_rows($res);
            if($ammount > 0){
                if(password_verify($pswd, $row["Wachtwoord"])){
                    $type = $row['Type'];    
                    $_SESSION['name']= $name;
                    $_SESSION['Type']= $type;
                    header("location: index.php");
                }
                else{
                    echo("<p>geen juist wachtwoord</p>");
                }
                


                
            }else{
                echo("<p>geen juiste username</p>");
            }


        }
        elseif(isset($_POST['submit']) && empty($_POST['naam']) && empty($_POST['password'])) {
            echo("<p>username en passwoord niet ingevuld</p>");
        }
        

        ?>

         <footer>
            <hr>
            <p>Copyright © Thomas More Mechelen-Antwerpen vzw - 
                Campus De Nayer - Professionele bachelor elektronica-ict – 
                2022</p>
        </footer>
        <hr>
        
    </body>
</html>