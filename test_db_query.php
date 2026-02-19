<?php
// Secure Database Probe
$token = "4f8a2b9d1c7e6f3a5b0d4e8c9f2a1b7d";
if (!isset($_GET['t']) || $_GET['t'] !== $token)
    die("Denied");

$host = 'localhost';
$user = 'sariasih_root';
$pass = 'kebumen38';
$db = 'sariasih_simklinikdev';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error)
    die("Connection failed: " . $mysqli->connect_error);

$id = $_GET['id'] ?? '';
echo "<h3>Querying ID: [$id]</h3>";

$sql = "SELECT * FROM mst_dokter WHERE id_dokter = '" . $mysqli->real_escape_string($id) . "'";
$res = $mysqli->query($sql);

if ($res->num_rows > 0) {
    echo "<pre>";
    print_r($res->fetch_assoc());
    echo "</pre>";
} else {
    echo "No record found for ID: $id<br>";
    echo "Listing first 5 records:<br>";
    $res2 = $mysqli->query("SELECT id_dokter, name FROM mst_dokter LIMIT 5");
    while ($row = $res2->fetch_assoc()) {
        echo " - " . $row['id_dokter'] . " : " . $row['name'] . "<br>";
    }
}
$mysqli->close();
?>