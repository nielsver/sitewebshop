<?php
session_start();
include_once "ErrorHandling.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" >
        <title>contact</title>
        <link href="reset.css" rel="stylesheet">
        <link href="contact.css" rel="stylesheet">
        <script src="jquery.js"></script>
        <link href="jquery-ui-1.13.1.custom/jquery-ui.css" rel="stylesheet">
        <script src="jquery-ui-1.13.1.custom/external/jquery/jquery.js"></script>
        <script src="jquery-ui-1.13.1.custom/jquery-ui.js"></script>
        <script>
            $(document).ready(function(){
                $("#submit").click(function(event){
                   var naam = $("#naam").val();
                   var voornaam = $("#voornaam").val();
                   var bericht = $("#bericht").val();
                   naam = htmlspecialchars(naam);
                   voornaam = htmlspecialchars(voornaam);
                   bericht = htmlspecialchars(bericht);
                   if (naam == "" || voornaam == "" || bericht == ""){
                    event.preventDefault();
                    $(".error").show();
                    if(naam == ""){
                        $("#naam").focus();
                    }else if (voornaam == ""){
                        $("#voornaam").focus();
                    }else{
                        $("#bericht").focus();
                    }
                   }
                   else{
                      
                      $(".error").hide();
                      $("form").submit();
                       
                   }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                  $( "#datepicker" ).datepicker({
                 inline: true
                })
                $( "#dialog-link, #icons li" ).hover(
                    function() {
                        $( this ).addClass( "ui-state-hover" );
                    },
                    function() {
                        $( this ).removeClass( "ui-state-hover" );
                    }
                )
            });
   
</script>

    </head>
    <body>
        <header>
            <h1>contact</h1>
            <hr>
            <p>velden met een <span>*</span> zijn verplicht</p>
        </header>   
            <nav>
            <?php 
            if(isset($_SESSION['name'])){

            ?>
            <a id="link3" href="index.php">Home</a>
            <a href="webshop.php">Webshop</a>
            <a href="mijnbestellingen.php">bestellingen</a>
            <a href="winkelmandje.php">cart</a>
            <a id="link1" href="logout.php">logout</a>
            <?php 
            }else{
                
            ?>
            <a id="link3" href="index.php">Home</a>
            <a href="webshop.php">Webshop</a>
            <a id="link1" href="login.php">login</a>
            <?php
            }
            ?>
            </nav>
        <form action="mailto:r0879765@student.thomasmore.be" method="post" enctype="text/plain">
            <label for="naam">naam: <span>*</span> </label>
            <input type="text" id="naam" name="naam" placeholder="naam">
            <br>
            <label for="voornaam">voornaam: <span>*</span></label>
            <input type="text" id="voornaam" name="voornaam" placeholder="voornaam">
            <br>
            <label for="telefoon">telefoon: </label>
            <input type="tel" id="telefoon" name="telefoon" placeholder="telefoon">
            <br>
            <label for="datepicker">geboortedatum: </label>
            <input type="date" id="datepicker" name="geboortedatum">
            <br>
            <label for="bericht" >bericht: <span>*</span> </label><br>
            <textarea id="bericht" name="bericht" placeholder="bericht"></textarea>
            <div class="error">There are item that require your attention</div>
            <br>
        <br>
            <button class="knop" id="submit" type="submit" >verstuur</button>
            <input class="knop" id="reset" type="reset" value="reset">
        </form>
        <footer>
            <hr>
            <p>Copyright © Thomas More Mechelen-Antwerpen vzw - 
                Campus De Nayer - Professionele bachelor elektronica-ict - 
                2022</p>
            <hr>    
        </footer>
        
    </body>
</html>