<?php
session_start();
include_once "ErrorHandling.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" >
        <title>admin</title>
        <link href="reset.css" rel="stylesheet">
        <link href="adminpage.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
 
	$(document).ready(function()
	{
		$("#search").keyup(function()
		{
			$searchString = $("#search").val();
			console.log($searchString);
			
			$request = $.ajax({
				method:"POST",
                url:"./zoek.php",
				data: {search: $searchString},
			});
			
			$request.done(function(msg)
			{
				$("#feedback").fadeOut("slow", function()
				{
					$("#feedback").html(msg);
					$("#feedback").fadeIn("slow");
				});
				
			});
			
		});
	
	});
    $(document).ready(function()
	{
		$("#zoek").keyup(function()
		{
			$searchString = $("#zoek").val();
			console.log($searchString);
			
			$request = $.ajax({
				method:"POST",
                url:"./zoeku.php",
				data: {search: $searchString},
			});
			
			$request.done(function(msg)
			{
				$("#feedbacku").fadeOut("slow", function()
				{
					$("#feedbacku").html(msg);
					$("#feedbacku").fadeIn("slow");
				});
				
			});
			
		});
	
	});
</script>
    </head>
    <body>
        <?php
        if($_SESSION['Type'] == 'A'){
            
        
        ?>
        <h1>Admin pagina</h1>
        <hr>
        <form id="productform" enctype="multipart/form-data" action="?php $_SERVER['PHP_SELF'];?>" method="POST">
            <h2>Product toevoegen</h2>
            <br>
            <br>
            <label for="product">productnaam: </label>
            <input type="text" name="product" id="product" required>
            <br>
            <br>
            <label for="categorie">categorie: </label>
            <input type="text" name="categorie" id="categorie" required>
            <br>
            <br>
            <label for="image">image: </label>
            <input type="file" name="image" id="image" accept="image/jpeg, image/png" required>
            <br>
            <br>
            <label for="number">prijs: </label> 
            <input type="number" name="prijs" id="prijs" required>
            <br>
            <br>
            <input type="submit" value="+ Product" name="submit" id="submit">

        </form>
        <form id="gebruikerform" action="?php $_SERVER['PHP_SELF'];?>" method="POST">
            <h2>Gebruiker toevoegen</h2>
            <br>
            <br>
            <label for="User">gebruikersnaam: </label>
            <input type="text" name="User" id="User" required>
            <br>
            <br>
            <label for="wachtwoord">wachtwoord: </label>
            <input type="text" name="wachtwoord" id="wachtwoord" required>
            <br>
            <br>
            <label for="Postcode">Postcode: </label>
            <input type="text" name="Postcode" id="Postcode" required>
            <br>
            <br>
            <label for="stad">stad: </label> 
            <input type="text" name="stad" id="stad" required>
            <br>
            <br>
            <label for="type">type: </label> 
            <select name="type" id="type" value="U" required>
                <option value="U">User</option>
                <option value="A">Admin</option>
            </select>
            <br>
            <br>
            <input type="submit" name="submit1" value="+ Gebruiker" id="submit1">

        </form>
        <div id="back">
            <a href="./webshop.php">terug</a>
        </div>
        <form id="center" action="?php $_SERVER['PHP_SELF'];?>" method="POST">
            <label for="product">productid: </label>
            <input type="number" name="product" id="product" required>
            <h2>Wat wil je aanpassen</h2>
            <br>
            <br>
            <label for="naam">naam: </label>
            <input type="text" name="naam" id="naam">
            <br>
            <br>
            <label for="categorie">categorie: </label>
            <input type="text" name="categorie" id="categorie">
            <br>
            <br>
            <label for="number">prijs: </label> 
            <input type="number" name="prijs" id="prijs">
            <br>
            <br>
            <input type="submit" value="Aanpassen" name="submit3" id="submit3">
        </form>

        <?php
        }
        else{
            Header("location: index.php");
        }
        if(isset($_POST['submit'])) {
            $product= htmlspecialchars($_POST['product']);
            $categorie = htmlspecialchars($_POST['categorie']);
            $prijs = htmlspecialchars($_POST['prijs']);
            $data = file_get_contents($_FILES['image']['tmp_name']);
            $type = ($_FILES['image']['type']);
            $data = 'data:image/'. $type.';base64,'.base64_encode($data);
            

            $host = "localhost";
            $user = "Webusers"; 
            $password = "Lab2021";
            $database = "webshop";

            $link = mysqli_connect($host,$user,$password) or die("Error: No connection to the host");
            mysqli_select_db($link, $database) or die("Error: no database found");

            $query = "insert into tblproducten (Naam, Categorie, Foto, Prijs, Actief)
                    Values
                    ('".$product."',
                     '".$categorie."',
                     '".$data."',
                     '".$prijs."',  
                     'Y' )";
                     
                     $result = mysqli_query($link, $query) or die("Error: executing the query");
                     mysqli_close($link);
                     echo("<p>product succesvol toegevoegd</p>");
        }
        if(isset($_POST['submit1'])) {
            $name= htmlspecialchars($_POST['User']);
            $passwordinput = htmlspecialchars($_POST['wachtwoord']);
            $postcode = htmlspecialchars($_POST['Postcode']);
            $stad = htmlspecialchars($_POST['stad']);
            $type = htmlspecialchars($_POST['type']);
            if($name == "john doe"){
                throw new Exception("$name is an example name");
            }

            $host = "localhost";
            $user = "Webusers";
            $password = "Lab2021";
            $database = "webshop";

            $passwordhashed = password_hash($passwordinput, PASSWORD_DEFAULT);
    
            $link = mysqli_connect($host,$user,$password) or die("Error: No connection to the host");
            mysqli_select_db($link, $database) or die("Error: no database found");

            $quer = "Select * From tblgebruikers Where Naam = '$name'";
            $res = mysqli_query($link, $quer) or throw new Error("Error: executing query");
            try
            {
                if(mysqli_num_rows($res) > 0){
                    throw new Exception("username bestaat al");
                }
            }
            catch (Exception $e){
                $log = new ErrorLog($e->getCode(), $e->getMessage(), 
			    $e->getFile(), $e->getLine());
                $log->WriteError();
                exit("Username bestaal al.");

            }
        
            $query = "insert into tblgebruikers (Naam, Wachtwoord, PostCode, Stad, Type,Actief)
            Values
            ('".$name."',
                '".$passwordhashed."',
                '".$postcode."',
                '".$stad."',  
                '".$type."',
                'Y' )";
                
                $result = mysqli_query($link, $query) or die("Error: executing the query");
                mysqli_close($link);
                echo("<p>gebruiker succesvol toegevoegd</p>");
            
        }
        if(isset($_POST['submit3'])){
            if(isset($_POST['product'])){
                $product= htmlspecialchars($_POST['product']);
            }
            if(isset($_POST['categorie'])){
                $categorie = htmlspecialchars($_POST['categorie']);
            }
            if(isset($_POST['prijs'])){
                $prijs = htmlspecialchars($_POST['prijs']);
            }
            if(isset($_POST['naam'])){
                $naam = htmlspecialchars($_POST['naam']);
            }
            $host = "localhost";
            $user = "Webusers"; 
            $password = "Lab2021";
            $database = "webshop";

            $link = mysqli_connect($host,$user,$password) or die("Error: No connection to the host");
            mysqli_select_db($link, $database) or die("Error: no database found");

            $queryadapt = "SELECT * From tblproducten Where ProductId = '$product'";
            $res3 = mysqli_query($link, $queryadapt) or die("Error: executing query");
            if(mysqli_num_rows($res3) == 0){
                echo("<p>Geen juiste Id</p>");
            }else if(mysqli_num_rows($res3) > 1){
                echo("<p>fout opgetreden</p>");
            }else{
                if(empty($categorie) && empty($prijs) && empty($naam)){
                    echo("<p>voeg een waarde om aan te passen</p>");
                }else{
                    if(!empty($categorie)){
                        if(!empty($naam)){
                            if(!empty($prijs)){
                                $query3 = "UPDATE tblproducten Set Categorie = '$categorie',Naam = '$naam', Prijs = $prijs where ProductId = $product";
                                $result3 = mysqli_query($link, $query3) or die("Error: executing the query");
                                mysqli_close($link);
                                echo("<p>Product geupdate</p>");
                            }
                            else{
                                $query3 = "UPDATE tblproducten Set Categorie = '$categorie',Naam ='$naam' where ProductId = $product";
                                $result3 = mysqli_query($link, $query3) or die("Error: executing the query");
                                mysqli_close($link);
                                echo("<p>Product geupdate</p>");
                            }
                        }
                        else if(!empty($prijs)) {
                            $query3 = "UPDATE tblproducten Set Categorie = '$categorie', Prijs = $prijs where ProductId = $product";
                            $result3 = mysqli_query($link, $query3) or die("Error: executing the query");
                            mysqli_close($link);
                            echo("<p>Product geupdate</p>");
                        }
                        else{
                            $query3 = "UPDATE tblproducten Set Categorie = '$categorie' where ProductId = $product";
                            $result3 = mysqli_query($link, $query3) or die("Error: executing the query");
                            mysqli_close($link);
                            echo("<p>Product geupdate</p>");
                        }
                        
                    }
                    else if(!empty($prijs)){
                        if(!empty($naam)){
                            $query3 = "UPDATE tblproducten Set Naam = '$naam,' Prijs = $prijs where ProductId = $product";
                            $result3 = mysqli_query($link, $query3) or die("Error: executing the query");
                            mysqli_close($link);
                            echo("<p>Product geupdate</p>");
                        }else{
                            $query3 = "UPDATE tblproducten Set Prijs = $prijs where ProductId = $product";
                            $result3 = mysqli_query($link, $query3) or die("Error: executing the query");
                            mysqli_close($link);
                            echo("<p>Product geupdate</p>");
                        }
                    }
                    else if(!empty($naam)){
                        $query3 = "UPDATE tblproducten Set Naam = '$naam' where ProductId = $product";
                        $result3 = mysqli_query($link, $query3) or die("Error: executing the query");
                        mysqli_close($link);
                        echo("<p>Product geupdate</p>");  
                    }
                   
                }
            }
        }
        ?>
    <form id="product" action="#">
	  <p>
		Zoek Product &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="search" name="input"/>
	  </p>
      <div id="feedback"></div>


	</form>
    <form id="gebruiker" action="#">
	  <p>
		Zoek Gebruiker &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="zoek" name="input"/>
	  </p>
      <div id="feedbacku"></div>
      

	</form>
    </body>
</html>



