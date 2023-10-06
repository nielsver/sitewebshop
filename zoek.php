<?php
session_start();
include_once "ErrorHandling.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function()
{
	$('#actief').click(function(){
		$id = $("productid").val();
			
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
	})
});
</script>
<?php

    $host = "localhost";
    $user = "Webusers";
    $password = "Lab2021";
    $database = "webshop";
	
	if(isset($_POST['search']))
	{
		if(!empty($_POST['search']))
		{
			//establisch database connection
			$link = mysqli_connect($host,$user,$password) or die("Server not reachable");
			mysqli_select_db($link, $database) or die("Database not available");

			$query = "SELECT * FROM tblproducten WHERE Naam LIKE ?";
			$stmt = mysqli_prepare($link, $query);			
			$search = "%".htmlspecialchars($_POST['search'])."%";
			mysqli_stmt_bind_param($stmt, "s", $search);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$productid, $naam, $categorie,$foto,$prijs, $actief);
			
			mysqli_stmt_store_result($stmt);
			if(mysqli_stmt_num_rows($stmt) == 0)
			{
				echo "<p>Geen resultaten.</p>";
			}
			else
			{
				echo("<table><tr><th>product id</th><th>productnaam</th><th>categorie</th><th>prijs</th><th>actief</th></tr>");
				while(mysqli_stmt_fetch($stmt))
				{
					echo("<tr><td>".htmlspecialchars($productid)."</td>");
					echo("<td>".htmlspecialchars($naam)."</td>");
					echo("<td>".htmlspecialchars($categorie)."</td>");
					echo("<td>".htmlspecialchars($prijs)."</td>");
                    echo("<td>".htmlspecialchars($actief)."</td>");
					echo("<td><a href='zoek.php?data=".$productid."&keuze=actief'>Actief</a>");
					echo("<td><a href='zoek.php?data=".$productid."&keuze=Verwijderen'>verwijderen</a></tr>");
				}
				echo("</table>");
			}
		}
		else
		{
			echo ("<p>Geef minstens 1 letter!</p>");
		}
		
	}
	if(isset($_GET["keuze"])){
		$link = mysqli_connect($host,$user,$password) or die("Server not reachable");
		mysqli_select_db($link, $database) or die("Database not available");
		if($_GET["keuze"] == "actief"){
			$tedeactiverenid = $_GET["data"];
			$checkquery = "SELECT * FROM tblproducten WHERE ProductId = $tedeactiverenid";
			$stmt4 = mysqli_query($link, $checkquery);
			$status = mysqli_fetch_array($stmt4);
			if($status["Actief"] == "Y"){
				$deactivatiequery = "UPDATE tblproducten SET Actief = 'N' WHERE ProductId = $tedeactiverenid";
				$stmt1 = mysqli_query($link,$deactivatiequery) or die("Error: an error has occured while executing the query"); 
				Header("location: adminpage.php");

			}
			else{
				$activatiequery = "UPDATE tblproducten SET Actief = 'Y' WHERE ProductId= $tedeactiverenid";
				$stmt2 = mysqli_query($link,$activatiequery) or die("Error: an error has occured while executing the query");
				Header("location: adminpage.php");
			}
		}
		elseif($_GET["keuze"] == "Verwijderen"){
			$teverijwijderenid = $_GET["data"];
			$deletequery = "DELETE FROM tblproducten WHERE ProductId = $teverijwijderenid";
			$stmt3 = mysqli_query($link,$deletequery) or die("Error: an error has occured while executing the query");
			Header("location: adminpage.php");
		}
	}

	
	?>