<?php
include_once "ErrorHandling.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" >
        <link href="reset.css" rel="stylesheet" >
        <link href="register.css" rel="stylesheet" >
        <title>register</title>
    </head>
    <body> 
        <h1>Register page</h1>
        <hr>
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
        <input type="text" placeholder="naam" name="naam" id="naam" required>
        <br>
        <input type="number" placeholder="postcode" name="postcode" id="postcode" required>
        <br>
        <input type="text" placeholder="stad" name="stad" id="stad" required>
        <br>
        <input type="password" placeholder="Enter Password" name="paswoord" id="paswoord" required>
        <br>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
        <br>
        <button type="submit" class="knop" name="submit" id="submit">Register</button>
        <br>
        <a href="login.php" class="knop">back</a>
        <button type="reset" class="knop">reset</button>
        </form>
        <?php
        if(isset($_POST['submit'])) {
            $name= htmlspecialchars($_POST['naam']);
            $passwordinput = htmlspecialchars($_POST['paswoord']);
            $postcode = htmlspecialchars($_POST['postcode']);
            $stad = htmlspecialchars($_POST['stad']);
            $pswrepeat = htmlspecialchars($_POST['psw-repeat']);

            $host = "localhost";
            $user = "Webusers";
            $password = "Lab2021";
            $database = "webshop";

            if($name == "john doe"){
                throw new Exception("$name is an example name");
            }

            $passwordhashed = password_hash($passwordinput, PASSWORD_DEFAULT);
    
            $link = mysqli_connect($host,$user,$password) or die("Error: No connection to the host");
            mysqli_select_db($link, $database) or throw new Error("No database found");

            $quer = "Select * From tblgebruikers Where Naam = '$name'";
            $res = mysqli_query($link, $quer) or throw new Error("Error: executing query");

            if(mysqli_num_rows($res) > 0){
                echo("<p>gebruikersnaam bestaal al </p>");
            }else{
                if($passwordinput == $pswrepeat){
                    $query = "insert into tblgebruikers (Naam, Wachtwoord, PostCode, Stad, Type)
                    Values
                    ('".$name."',
                     '".$passwordhashed."',
                     '".$postcode."',
                     '".$stad."',  
                     'U' )";
                     
                     $result = mysqli_query($link, $query) or throw new Error("Error: executing query");
                     mysqli_close($link);
                     Header("location: login.php");
                }
                else{
                    echo("<p>paswoorden zijn niet hetzelfde</p>");
                }
            }
            
            mysqli_close($link);
            
        }
        
        ?>
        <footer>
            <hr>
            <p>Copyright © Thomas More Mechelen-Antwerpen vzw - 
                Campus De Nayer - Professionele bachelor elektronica-ict – 
                2022</p>
                <hr>
        </footer>
    </body>
</html>