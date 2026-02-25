<?php
// functie: formulier en database insert fiets
// auteur: Sumaia

echo "<h1>Insert Fiets</h1>";

require_once('function.php');

// Test of er op de insert-knop is gedrukt
if(isset($_POST) && isset($_POST['btn_ins'])){

    // test of insert gelukt is
    if(insertRecord($_POST) == true){
        echo "<script>alert('Fiets is toegevoegd')</script>";
        echo "<script> location.replace('index.php'); </script>";
    } else {
        echo "<script>alert('Fiets is NIET toegevoegd')</script>";
    }
}
?>
<html>
<body>
<form method="post">

<label for="merk">Merk:</label>
<input type="text" id="merk" name="merk" required><br>

<label for="type">Type:</label>
<input type="text" id="type" name="type" required><br>

<label for="prijs">Prijs:</label>
<input type="number" step="0.01" id="prijs" name="prijs" required><br>

<button type="submit" name="btn_ins">Insert</button>
</form>

<br><br>
<a href='index.php'>Home</a>
</body>
</html>
