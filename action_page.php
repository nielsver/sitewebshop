<?php
session_start();
include_once "ErrorHandling.php";
$host = "localhost";
$user = "Webusers";
$password = "Lab2021";
$database = "webshop";
$link = mysqli_connect($host, $user, $password) or die("Error: no connection can be made to the host");
mysqli_select_db($link, $database) or die("Error: the database could not be opened");
$query1 = "SELECT GebruikerId From tblgebruikers where Naam = '".$_SESSION['name']."'";
$res = mysqli_query($link, $query1) or throw new Error("Error: executing query");
$gebruikersid = mysqli_fetch_array($res);
$query2 = "SELECT * FROM tblproducten where Actief = 'Y'";
$result1 = mysqli_query($link,$query2);
$numberRecords = mysqli_num_rows($result1);
if($numberRecords == 0){
    echo("<h2>onverwacht probleem opgetreden</h2>");
}
else{
    $datum = date("Y/m/d");
    $keys = array_keys($_SESSION["cart"]);
    while($row = mysqli_fetch_array($result1)){
        foreach(array_keys($_SESSION["cart"]) as $keys => $value){
            if($row["ProductId"] == $value){
                if($_SESSION["cart"][$row["ProductId"]]["hoeveelheid"] != 0){
                    $aantal = $_SESSION["cart"][$row["ProductId"]]["hoeveelheid"];
                    $query = "insert into tblbestellingen (GebruikerId, ProductId, Datum, Betaald, Actief,Aantal)
                    Values
                    ('".$gebruikersid[0]."',
                    '".$value."',
                    '".$datum."',
                    'Y',  
                    'Y',
                    '".$aantal."')";
                    $result = mysqli_query($link, $query) or die("Error: executing the query");
                    $_SESSION["cart"][$row["ProductId"]]["hoeveelheid"] = 0;
                }
            }
        }
    }
}
 mysqli_close($link);
 header("Location: mijnbestellingen.php")

?>