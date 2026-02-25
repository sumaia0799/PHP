<?php
// functie: verwijderen fiets
// auteur: Sumaia

require_once('function.php');

// Haal fiets uit de database
if(isset($_GET['id'])){

    // test of delete gelukt is
    if(deleteRecord($_GET['id']) == true){
        echo '<script>alert("Fietscode: ' . $_GET['id'] . ' is verwijderd")</script>';
        echo "<script> location.replace('index.php'); </script>";
    } else {
        echo '<script>alert("Fiets is NIET verwijderd")</script>';
        echo "<script> location.replace('index.php'); </script>";
    }
} else {
    echo "<script>alert('Geen id meegegeven')</script>";
    echo "<script> location.replace('index.php'); </script>";
}
?>
