<?php
    session_start();
    include_once "ErrorHandling.php";
    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $_SESSION["cart"][$id]["hoeveelheid"]--;
        
    }
?>