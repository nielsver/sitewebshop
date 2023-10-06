<?php
session_start();
include_once "ErrorHandling.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" >
        <title>webshop</title>
        <link href="reset.css" rel="stylesheet">
        <link href="webshop.css" rel="stylesheet">
        <script src="jquery.js"></script>
        <script src="https://cdn.lordicon.com/fudrjiwc.js"></script>
    </head>
    <script>
        function setcookies($id) {
            var waarde = $id
            $.ajax({
                method: "POST",
                url: "setcookies.php",
                data: { id: waarde },
                success:function(){
                    alert("Product toegevoegd");
                }
            }).done()
        
        }
    </script>
    <script>
        function getproducten() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("section").innerHTML = this.responseText;
            }
            };
            xmlhttp.open("GET","showproducten.php",true);
            xmlhttp.send();
        }
        function showmin(str) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("section").innerHTML = this.responseText;
            }
            };
            xmlhttp.open("GET","showproducten.php?q="+str,true);
            xmlhttp.send();
        
        }
        function showmax(str) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("section").innerHTML = this.responseText;
            }
            };
            xmlhttp.open("GET","showproducten.php?z="+str,true);
            xmlhttp.send();
        
        }
        function showCategorie(str) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("section").innerHTML = this.responseText;
            }
            };
            xmlhttp.open("GET","showproducten.php?h="+str,true);
            xmlhttp.send();
            
        }
        function showproductenu() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("section").innerHTML = this.responseText;
            }
            };
            xmlhttp.open("GET","showproductenu.php",true);
            xmlhttp.send();
        }
        function showminu(str) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("section").innerHTML = this.responseText;
            }
            };
            xmlhttp.open("GET","showproductenu.php?q="+str,true);
            xmlhttp.send();
        
        }
        function showmaxu(str) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("section").innerHTML = this.responseText;
            }
            };
            xmlhttp.open("GET","showproductenu.php?z="+str,true);
            xmlhttp.send();
        
        }
        function showCategorieu(str) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("section").innerHTML = this.responseText;
            }
            };
            xmlhttp.open("GET","showproductenu.php?h="+str,true);
            xmlhttp.send();
            
        }
</script>
<?php 
$host = "localhost";
$user = "Webusers";
$password = "Lab2021";
$database = "webshop";
$link = mysqli_connect($host, $user, $password) or die("Error: no connection can be made to the host");
mysqli_select_db($link, $database) or die("Error: the database could not be opened");
if(isset($_SESSION['name'])){
    if($_SESSION['Type'] == 'A'){
    ?>
<body onload="getproducten()">
    <header>
        <h1>webshop Foto's</h1>
    </header>
    <nav>
        <a href="index.php">home</a>
        <a id="link3" href="contact.php">contact</a>
        <a href="winkelmandje.php">cart</a>
        <a href="mijnbestellingen.php">bestellingen</a>
        <a id="link1" href="logout.php">logout</a>
    </nav>
    <div id="filters">
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
            <input type="number" placeholder="min price" name="minprice" id="minprice" onchange="showmin(this.value)">
            <input type="number" placeholder="max price" name="maxprice" id="maxprice" onchange="showmax(this.value)">
            <select type="select" id="categorie" name="categorie" id="categorie" onchange="showCategorie(this.value)">
            <option value="">all</option>
                <?php
                    $queryopties = "SELECT distinct Categorie FROM tblproducten";
                    $opties = mysqli_query($link, $queryopties) or die("Error: an error has occurred while executing the query.");
                    $numberopties = mysqli_num_rows($opties);
                    while($optie = mysqli_fetch_assoc($opties))
                        echo("<option value=".$optie['Categorie'].">".$optie['Categorie']."");
                ?>
            </select> 
            
        </form>
    </div>
    <div id="knop">
        <lord-icon
        src="https://cdn.lordicon.com/yzqrwwtj.json"
        trigger="hover"
        onclick="location.href='./adminpage.php'"
        style="width:75px;height:75px">
    </lord-icon>
    </div>
    <aside>
        
        <span class="mouse">
            <span class="mouse-wheel"></span>
        </span>
    </aside>
    <section id="section">
        
    </section>

    <footer>
        <hr>
        <p>Copyright © Thomas More Mechelen-Antwerpen vzw - 
            Campus De Nayer - Professionele bachelor elektronica-ict – 
            2022</p>
            <hr>
    </footer>
</body>
<?php 
}else if($_SESSION['Type'] == 'U'){
?>
    <body onload="getproducten()">
        <header>
            <h1>webshop Foto's</h1>
        </header>
        <nav>
            <a href="index.php">home</a>
            <a id="link3" href="contact.php">contact</a>
            <a href="winkelmandje.php">cart</a>
            <a href="mijnbestellingen.php">bestellingen</a>
            <a id="link1" href="logout.php">logout</a>
        </nav>
        <div id="filters">
            <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
                <input type="number" placeholder="min price" name="minprice" id="minprice" onchange="showmin(this.value)">
                <input type="number" placeholder="max price" name="maxprice" id="maxprice" onchange="showmax(this.value)">
                <select type="select" id="categorie" name="categorie" id="categorie" onchange="showCategorie(this.value)">
                <option value="">all</option>
                    <?php
                        $queryopties = "SELECT distinct Categorie FROM tblproducten";
                        $opties = mysqli_query($link, $queryopties) or die("Error: an error has occurred while executing the query.");
                        $numberopties = mysqli_num_rows($opties);
                        while($optie = mysqli_fetch_assoc($opties))
                            echo("<option value=".$optie['Categorie'].">".$optie['Categorie']."");
                    ?>
                </select> 
                
            </form>
        </div>
        </div>
        <aside>
            
            <span class="mouse">
                <span class="mouse-wheel"></span>
            </span>
        </aside>
        <section id="section">
            
        </section>

    <footer>
        <hr>
        <p>Copyright © Thomas More Mechelen-Antwerpen vzw - 
                Campus De Nayer - Professionele bachelor elektronica-ict – 
              2022</p>
              <hr>
    </footer>
    </body>
    <?php
}
    }else{
        ?>  
    <body onload="showproductenu()">
        <header>
            <h1>webshop Foto's</h1>
        </header>
        <nav>
            <a href="index.php">home</a>
            <a id="link3" href="contact.php">contact</a>
            <a id="link1" href="login.php">login</a>
        </nav>
        <div id="filters">
            <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
                <input type="number" placeholder="min price" name="minprice" id="minprice" onchange="showminu(this.value)">
                <input type="number" placeholder="max price" name="maxprice" id="maxprice" onchange="showmaxu(this.value)">
                <select type="select" id="categorie" name="categorie" id="categorie" onchange="showCategorieu(this.value)">
                <option value="">all</option>
                    <?php
                        $queryopties = "SELECT distinct Categorie FROM tblproducten";
                        $opties = mysqli_query($link, $queryopties) or die("Error: an error has occurred while executing the query.");
                        $numberopties = mysqli_num_rows($opties);
                        while($optie = mysqli_fetch_assoc($opties))
                            echo("<option value=".$optie['Categorie'].">".$optie['Categorie']."");
                    ?>
                </select> 
                
            </form>
        </div>
        </div>
        <aside>
            
            <span class="mouse">
                <span class="mouse-wheel"></span>
            </span>
        </aside>
        <section id="section">
            
        </section>

        <footer>
            <hr>
            <p>Copyright © Thomas More Mechelen-Antwerpen vzw - 
                Campus De Nayer - Professionele bachelor elektronica-ict – 
                2022</p>
                <hr>
        </footer>
        <?php
        }
    
?>
    </body>
</html>