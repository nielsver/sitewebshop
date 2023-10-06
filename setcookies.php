<?php
    session_start();
    include_once "ErrorHandling.php";
    if(isset($_POST["id"])){
        
        $id = $_POST["id"];
        if(!isset($_SESSION["cart"][$id])){
            $_SESSION["cart"][$id] = array("hoeveelheid" => 1);
        }
        else {
            $_SESSION["cart"][$id]["hoeveelheid"]++;
        }
    }
?>