<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "utente", "password", "nome_database");

$result = $conn->query("SELECT id, nome, prezzo, img FROM prodotti");
$prodotti = [];

while ($row = $result->fetch_assoc()) {
    $prodotti[] = $row;
}

echo json_encode($prodotti);
?>


