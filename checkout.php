<?php
require_once 'dbconfig.php';
header("Content-Type: application/json");

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

$action = $_GET['action'] ?? '';

if ($action === "aggiungi") {
    $user_id = $_POST['user_id'];
    $prodotto_id = $_POST['prodotto_id'];
    $nome = $_POST['nome'];
    $prezzo = $_POST['prezzo'];
    $img = $_POST['img'];

    
    $check = "SELECT * FROM carrello WHERE user_id = $user_id AND prodotto_id = $prodotto_id";
    $res_check = mysqli_query($conn, $check);
    
    if (mysqli_num_rows($res_check) > 0) {
        
        $query = "UPDATE carrello SET quantità = quantità + 1 WHERE user_id = $user_id AND prodotto_id = $prodotto_id";
    } else {
      
        $query = "INSERT INTO carrello (user_id, prodotto_id, nome, prezzo, img) VALUES ($user_id, $prodotto_id, '$nome', $prezzo, '$img')";
    }

    mysqli_query($conn, $query);
    echo json_encode(["success" => true]);
}

if ($action === "visualizza") {
    $user_id = $_GET['user_id'];
    $query = "SELECT * FROM carrello WHERE user_id = $user_id";
    $res = mysqli_query($conn, $query);
    $prodotti = mysqli_fetch_all($res, MYSQLI_ASSOC);
    echo json_encode($prodotti);
}

if ($action === "rimuovi") {
    $id = $_POST['id'];
    $query = "DELETE FROM carrello WHERE id = $id";
    mysqli_query($conn, $query);
    echo json_encode(["success" => true]);
}
?>
