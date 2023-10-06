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
                url:"./zoeku.php",
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

			$query = "SELECT * FROM tblgebruikers WHERE Naam LIKE ?";
			$stmt = mysqli_prepare($link, $query);			
			$search = "%".htmlspecialchars($_POST['search'])."%";
			mysqli_stmt_bind_param($stmt, "s", $search);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$GebruikerId, $naam, $wachtwoord,$Postcode,$stad,$type, $actief);
			
			mysqli_stmt_store_result($stmt);
			if(mysqli_stmt_num_rows($stmt) == 0)
			{
				echo "<p>Geen resultaten.</p>";
			}
			else
			{
				echo("<table><tr><th>Gebruiker id</th><th>naam</th><th>postcode</th><th>stad</th><th>type</th><th>actief</th></tr>");
				while(mysqli_stmt_fetch($stmt))
				{
					echo("<tr><td>".htmlspecialchars($GebruikerId)."</td>");
					echo("<td>".htmlspecialchars($naam)."</td>");
					echo("<td>".htmlspecialchars($Postcode)."</td>");
                    echo("<td>".htmlspecialchars($stad)."</td>");
                    echo("<td>".htmlspecialchars($type)."</td>");
                    echo("<td>".htmlspecialchars($actief)."</td>");
                    echo("<td><a href='zoeku.php?data=".$GebruikerId."&keuze=type'>type</a>");
					echo("<td><a href='zoeku.php?data=".$GebruikerId."&keuze=actief'>Actief</a>");
					echo("<td><a href='zoeku.php?data=".$GebruikerId."&keuze=Verwijderen'>verwijderen</a></tr>");
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
			$checkquery = "SELECT * FROM tblgebruikers WHERE GebruikerId = $tedeactiverenid";
			$stmt4 = mysqli_query($link, $checkquery);
			$status = mysqli_fetch_array($stmt4);
			if($status["Actief"] == "Y"){
				$deactivatiequery = "UPDATE tblgebruikers SET Actief = 'N' WHERE GebruikerId = $tedeactiverenid";
				$stmt1 = mysqli_query($link,$deactivatiequery) or die("Error: an error has occured while executing the query"); 
				Header("location: adminpage.php");

			}
			else{
				$activatiequery = "UPDATE tblgebruikers SET Actief = 'Y' WHERE GebruikerId= $tedeactiverenid";
				$stmt2 = mysqli_query($link,$activatiequery) or die("Error: an error has occured while executing the query");
				Header("location: adminpage.php");
			}
		}
		elseif($_GET["keuze"] == "Verwijderen"){
			$teverijwijderenid = $_GET["data"];
			$deletequery = "DELETE FROM tblgebruikers WHERE GebruikerId = $teverijwijderenid";
			$stmt3 = mysqli_query($link,$deletequery) or die("Error: an error has occured while executing the query");
			Header("location: adminpage.php");
		}
        elseif($_GET["keuze"] == "type"){
            $tetyperenid = $_GET["data"];
			$checkquery1 = "SELECT * FROM tblgebruikers WHERE GebruikerId = $tetyperenid";
			$stmt5 = mysqli_query($link, $checkquery1);
			$status1 = mysqli_fetch_array($stmt5);
			if($status1["Type"] == "U"){
				$detypA = "UPDATE tblgebruikers SET Type = 'A' WHERE GebruikerId = $tetyperenid";
				$stmt6 = mysqli_query($link,$detypA) or die("Error: an error has occured while executing the query"); 
				Header("location: adminpage.php");

			}
			else{
				$detypU = "UPDATE tblgebruikers SET Type = 'U' WHERE GebruikerId= $tetyperenid";
				$stmt7 = mysqli_query($link,$detypU) or die("Error: an error has occured while executing the query");
				Header("location: adminpage.php");
			}
        }
	}
	
	?>