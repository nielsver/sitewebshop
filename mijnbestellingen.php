<?php
session_start();
include_once "ErrorHandling.php";
if(isset($_SESSION["name"])){
    $host = "localhost";
    $user = "Webusers";
    $password = "Lab2021";
    $database = "webshop";
    $link = mysqli_connect($host, $user, $password) or die("Error: no connection can be made to the host");
    mysqli_select_db($link, $database) or die("Error: the database could not be opened");
    $query = "SELECT GebruikerId FROM tblgebruikers Where Naam ='".$_SESSION["name"]."'";
    $res = mysqli_query($link, $query) or die("Error: executing the query");
    $gebruiker = mysqli_fetch_array($res);
    $quer = "SELECT * From tblbestellingen WHERE GebruikerId = $gebruiker[0]";
    $res1 = mysqli_query($link, $quer) or throw new Error("Error: executing query");
?>
<head>
        <meta charset="utf-8" >
        <title>mijnbestellingen</title>
        <link href="reset.css" rel="stylesheet">
        <link href="mijnbestellingen.css" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Uw bestellingen</h1>
    </header>
    <nav>
            <a href="index.php">home</a>
            <a id="link3" href="contact.php">contact</a>
            <a href="webshop.php">Webshop</a>
            <a href="winkelmandje.php">cart</a>
            <a id="link1" href="logout.php">logout</a>
    </nav>       
    <?php
         $numberRecords = mysqli_num_rows($res1);
         if($numberRecords == 0){
             echo("<h1>U heeft nog geen bestellingen</h1>");
         }
         else{
            echo("<table><tr><th>ProductId</th><th>Datum</th><th>Betaald</th><th>Aantal</th></tr>");
             while($row = mysqli_fetch_array($res1)){
                 if($row["Actief"] == "Y"){
					echo("<tr><td>".$row["ProductId"]."</td>");
					echo("<td>".$row["Datum"]."</td>");
					echo("<td>".$row["Betaald"]."</td>");
                    echo("<td>".$row["Aantal"]."</td></tr>");

                 }
     
             }
         }
    ?>


</body>
<?php
}else{
    header("location: index.php");
}
?>