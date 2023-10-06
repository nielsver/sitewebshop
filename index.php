<?php
session_start();
include_once "ErrorHandling.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" >
        <link href="reset.css" rel="stylesheet" >
        <link href="index.css" rel="stylesheet" >
        <script src="jquery.js"></script>
        <title>home pagina</title>
        <script>
            var breedte = 40;
            var buffer = "";
            for( i=1;i<breedte;i++){
                buffer += " ";
            }
            var scrolltekst = "WELKOM OP DE HOME PAGINA";
            var boodschap = buffer+scrolltekst+buffer;
            var teller = 0;

            function scrollmessage(){
                document.getElementById("venster").value=boodschap.substr(teller+1,breedte);
                setTimeout("scrollmessage()",100);
                teller++;
                if(teller==scrolltekst.length+breedte)
                {
                    teller=0;
                }
            }
        </script>
    </head>
    <body onload="scrollmessage()">
        <div id="header"> 
            <form action="#">
                <h1>
                    <input type="text" id="venster" size="40"/>
                </h1>
            </form>
        </div>
        <nav>
            <?php 
            if(isset($_SESSION['name'])){

            ?>
            <a id="link3" href="contact.php">contact</a>
            <a href="webshop.php">Webshop</a>
            <a href="winkelmandje.php">cart</a>
            <a href="mijnbestellingen.php">bestellingen</a>
            <a id="link1" href="logout.php">logout</a>
            <?php 
            }else{
                
            ?>
            <a id="link3" href="contact.php">contact</a>
            <a href="webshop.php">Webshop</a>
            <a id="link1" href="login.php">login</a>
            <?php
            }
            ?>
        </nav>
        <div id="article">
            <h2>
                over deze website
            </h2>
            <p>
                Deze website is gemaakt door Niels Vervoort. Voor het vak PHP, Mysql op de hogeschool Thomas More Denayer. 
                Ik heb deze website gemaakt in html, css, javascript, PHP, ajax.
            </p>
            
        </div>
        <aside>
            <img src="picture.jpg" alt="picture">
        </aside>
        
        <footer>
            <hr>
            <p>Copyright © Thomas More Mechelen-Antwerpen vzw - 
                Campus De Nayer - Professionele bachelor elektronica-ict – 
                2022</p>
        </footer>
        <hr>

    </body> 

</html>