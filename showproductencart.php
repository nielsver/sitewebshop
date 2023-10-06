<?php
session_start();
include_once "ErrorHandling.php";
    $host = "localhost";
    $user = "Webusers";
    $password = "Lab2021";
    $database = "webshop";
    $link = mysqli_connect($host, $user, $password) or die("Error: no connection can be made to the host");
    mysqli_select_db($link, $database) or die("Error: the database could not be opened");
    $query = "SELECT * FROM tblproducten where Actief = 'Y'";
    $result = mysqli_query($link,$query);
    $numberRecords = mysqli_num_rows($result);
    if($numberRecords == 0){
        echo("<h2>onverwacht probleem opgetreden</h2>");
    }
    else{
        $keys = array_keys($_SESSION["cart"]);
        $totaal = 0;
        while($row = mysqli_fetch_array($result)){
            foreach(array_keys($_SESSION["cart"]) as $keys => $value){
            if($row["ProductId"] == $value){
                if($_SESSION["cart"][$row["ProductId"]]["hoeveelheid"] != 0){
                    echo("<p>aantal: ". $_SESSION["cart"][$row["ProductId"]]["hoeveelheid"]."</p>
                    <div class=".'admin'."><p>Product: "
                    .$row['Naam']."</p>
                    <img src=\"".$row['Foto']. "\" height='150' width='150' alt='foto'>
                    <p>Categorie: "
                    .$row['Categorie']."</p><p>Prijs: "
                    .$row['Prijs']." euro</p>
                    <button class='min1' value=".$row['ProductId']." onclick='min1(".$row['ProductId'].")'>less</button>
                    <button class='reset' value=".$row['ProductId']." onclick='reset(".$row['ProductId'].")'>delete</button>                    
                    </div>
                    ");
                    $totaal =  $totaal + ($_SESSION["cart"][$row["ProductId"]]["hoeveelheid"] * $row['Prijs']);
                }
            }

        }
    }
    $_SESSION["totaal"] = $totaal;
    }
?>