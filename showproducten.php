<?php
include_once "ErrorHandling.php";
        $host = "localhost";
        $user = "Webusers";
        $password = "Lab2021";
        $database = "webshop";
        $link = mysqli_connect($host, $user, $password) or die("Error: no connection can be made to the host");
        mysqli_select_db($link, $database) or die("Error: the database could not be opened");
        $query = "SELECT * FROM tblproducten where Actief = 'Y'";
        if(isset($_GET['q'])){
            $q = ($_GET['q']);
        }
        if(isset($_GET['z'])){
            $z= ($_GET['z']);
        }
        if(isset($_GET['z'])){
            $z = ($_GET['z']);
        }
        if(isset($_GET['q']) && !empty($_GET['q'])){
            $query .= " AND Prijs >= ".$_GET['q']."";
        }
        if(isset($_GET['z']) && !empty($_GET['z'])){
            $query .= " AND Prijs <= ".$_GET['z']."";
            
        }
        if(isset($_GET['h']) && !empty($_GET['h'])){
            $query .= " AND Categorie = '".$_GET['h']."'";
            
        }
        $result = mysqli_query($link,$query);
        $numberRecords = mysqli_num_rows($result);
        if($numberRecords == 0){
            echo("<h2>no records found</h2>");
        }
        else{
            while($row = mysqli_fetch_array($result)){
                if($row["Actief"] == "Y"){
                    echo("<div class=".'admin'."><p>Product: "
                    .$row['Naam']."</p>
                    <img src=\"".$row['Foto']. "\" height='300' width='300'  alt='foto'>
                    <p>Categorie: "
                    .$row['Categorie']."</p><p>Prijs: "
                    .$row['Prijs']." euro</p>
                    <button class='cart' onclick='setcookies(".$row['ProductId'].")' value=".$row['ProductId'].">add to cart</button>
                    </div>
                    ");
                }
    
            }
        }
        
        
?>