<?php

$conn = mysqli_connect("localhost", "root", "root", "cijfersysteem");

$sql = "SELECT leerling, cijfer FROM cijfers";
$result = mysqli_query($conn, $sql);
echo "<h2>Cijfersysteem</h2>";

echo "<table border='1'>";
echo "<tr><th>Leerling</th><th>Cijfer</th></tr>";

while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>".$row['leerling']."</td>";
    echo "<td>".$row['cijfer']."</td>";
    echo "</tr>";
}

echo "</table>";

?>