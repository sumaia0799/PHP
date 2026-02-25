<?php
// functie: update fiets
// auteur: Sumaia

require_once('function.php');

// Test of er op de wijzig-knop is gedrukt 
if(isset($_POST['btn_wzg'])){

    // test of update gelukt is
    if(updateRecord($_POST) == true){
        echo "<script>alert('Fiets is gewijzigd')</script>";
        echo "<script> location.replace('index.php'); </script>";
    } else {
        echo '<script>alert("Fiets is NIET gewijzigd")</script>';
    }
}

// Test of id is meegegeven in de URL
if(isset($_GET['id'])){  
    $id = $_GET['id'];
    $row = getRecord($id);
} else {
    echo "Geen id opgegeven<br>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Wijzig Fiets</title>
</head>
<body>

<h2>Wijzig Fiets</h2>

<form method="post">

    <!-- verborgen id -->
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <label for="merk">Merk:</label>
    <input type="text" id="merk" name="merk" required value="<?php echo $row['merk']; ?>"><br><br>

    <label for="type">Type:</label>
    <input type="text" id="type" name="type" required value="<?php echo $row['type']; ?>"><br><br>

    <label for="prijs">Prijs:</label>
    <input type="number" step="0.01" id="prijs" name="prijs" required value="<?php echo $row['prijs']; ?>"><br><br>

    <button type="submit" name="btn_wzg">Wijzig</button>

</form>

<br><br>
<a href="index.php">Home</a>

</body>
</html>
