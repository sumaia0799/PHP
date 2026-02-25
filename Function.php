<?php
// auteur: Sumaia
// functie: eigen gemaakte functies

include_once "config.php";

function nl(){ echo "<br>"; }

function connectDb(){
    $dsn = "mysql:host=" . SERVERNAME . ";dbname=" . DATABASE . ";charset=utf8mb4";

    try {
        $conn = new PDO($dsn, USERNAME, PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}

function getData($table){
    $conn = connectDb();
    $sql = "SELECT * FROM $table";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertRecord($post): bool {
    $conn = connectDb();

    $sql = "
        INSERT INTO " . CRUD_TABLE . " (type, merk, prijs)
        VALUES (:type, :merk, :prijs)
    ";

    $values = [
        ':type' => $post['type'],
        ':merk' => $post['merk'],
        ':prijs' => $post['prijs']
    ];

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($values);
        return true;
    } catch (PDOException $e) {
        echo "Insert failed: " . $e->getMessage();
        return false;
    }
}

function deleteRecord($id): bool {
    $conn = connectDb();

    $sql = "DELETE FROM " . CRUD_TABLE . " WHERE id = :id";
    $values = [':id' => (int)$id];

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($values);
        return true;
    } catch(PDOException $e) {
        echo "Delete failed: " . $e->getMessage();
        return false;
    }
}
function getRecord($id){
    $conn = connectDb();

    $sql = "SELECT * FROM " . CRUD_TABLE . " WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => (int)$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateRecord($post): bool {
    $conn = connectDb();

    $sql = "UPDATE " . CRUD_TABLE . "
            SET merk = :merk, type = :type, prijs = :prijs
            WHERE id = :id";

    $values = [
        ':merk' => $post['merk'],
        ':type' => $post['type'],
        ':prijs' => $post['prijs'],
        ':id'   => (int)$post['id']
    ];

    $stmt = $conn->prepare($sql);
    return $stmt->execute($values);
}


function printCrudTabel($rows){
  echo "<table border='1' cellpadding='6' style='background:#9fe3cf'>";
    echo "<tr><th>id</th><th>type</th><th>merk</th><th>prijs</th><th>actie</th></tr>";

   foreach($rows as $r){
    echo "<tr>";
    echo "<td>{$r['id']}</td>";
    echo "<td>{$r['type']}</td>";
    echo "<td>{$r['merk']}</td>";
    echo "<td>{$r['prijs']}</td>";
    echo "<td>
            <a href='update.php?id={$r['id']}'>Wzg</a> |
            <a href='delete.php?id={$r['id']}'>Del</a>
          </td>";
    echo "</tr>";
}
echo "</table>";

}

function crudMain(){
    echo "
    <h1>Crud Fietsen</h1>
    <nav>
        <a href='insert.php'>Toevoegen nieuwe fiets</a>
    </nav><br>";

    $result = getData(CRUD_TABLE);
    printCrudTabel($result);
}
?>
