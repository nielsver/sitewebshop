<?php
session_start();
include_once "ErrorHandling.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" >
        <link href="reset.css" rel="stylesheet" >
        <link href="winkelmandje.css" rel="stylesheet" >
        <title>winkelmandje</title>
        <script src="jquery.js"></script>
        <script>
            function showproducten(){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("section").innerHTML = this.responseText;
                }
                };
                xmlhttp.open("GET","showproductencart.php",true);
                xmlhttp.send();
        }
            

        </script>
        <script>
        function min1($id) {
            var waarde = $id;
            $.ajax({
                method: "POST",
                url: "min1.php",
                data: { id: waarde }
            }).done();
        }
        function reset($id) {
            var waarde = $id;
            $.ajax({
                method: "POST",
                url: "resetcookies.php",
                data: { id: waarde }
            }).done();
        };

    </script>

    <?php 
    if(isset($_SESSION['name'])){
        if(!isset($_SESSION["cart"])){
            ?>
            <header>
            <h1>winkelmandje</h1>
            <nav>
            <a href="index.php">Home</a>
            <a id="link3" href="contact.php">contact</a>
            <a id="webshop" href="webshop.php">webshop</a>
            <a href="mijnbestellingen.php">bestellingen</a>
            <a id="link1" href="logout.php">logout</a>
            </nav>
        </header>
        <h1>Winkelmandje is leeg</h1>
            <?php   
        }else{
    ?>
    </head>
    <body onload="showproducten()">
        <header>
            <h1>winkelmandje</h1>
            <nav>
            <a href="index.php">Home</a>
            <a id="link3" href="contact.php">contact</a>
            <a id="webshop" href="webshop.php">webshop</a>
            <a href="mijnbestellingen.php">bestellingen</a>
            <a id="link1" href="logout.php">logout</a>
            </nav>
        </header>
        <div id="left">
        <section id="section">

        </section>
        </div>
        <div id="right">
        <div class="row">
  <div class="top">
    <div class="container">
      <form action="./action_page.php">

        <div class="row">
          <div class="sub">
            <h3>leveraddress</h3>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">
            <label for="adr">Address</label>
            <input type="text" id="adr" name="address" placeholder="stationstraat 1" required>
            <label for="city">Stad</label>
            <input type="text" id="stad" name="stad" placeholder="Mechelen" required>

            <div class="row">
              <div class="sub">
                <label for="provincie">Provincie</label>
                <input type="text" id="provincie" name="provincie" placeholder="Antwerpen" required> 
              </div>
              <div class="sub">
                <label for="postcode">postcode</label>
                <input type="text" id="postcode" name="postcode" placeholder="2800" required>
              </div>
            </div>
          </div>

          <div class="sub">
            <h3>Payment</h3>
            <label for="cname">Kaarthouder</label>
            <input type="text" id="cname" name="cardname" placeholder="John Doe">
            <label for="ccnum">Kaartnummer</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp maand</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">

            <div class="row">
              <div class="sub">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="sub">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>
        </div>
        <p>totaal te betalen: <?php
          if(isset($_SESSION["totaal"])){
                echo $_SESSION["totaal"];
          }
            ?> euro</p>
            <input type="submit" value="bestellen" id="bestellen"/>     
        </div>
    </div>
</div>

        
    </body>
    <?php 
        }
        }else{
            header("Location: index.php");
        }
        ?>
        
</html>