<?php
session_start();
$host = 'localhost';
$dbname = 'hw1';
$user = 'root';
$password = '';
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (isset($_POST['aggiungi_al_carrello'])) {
    $id_prodotto = $_POST['id_prodotto'];
    if (!isset($_SESSION['carrello'])) {
        $_SESSION['carrello'] = array();
    }
    if (isset($_SESSION['carrello'][$id_prodotto])) {
        $_SESSION['carrello'][$id_prodotto]['quantita'] += 1;
    } else {
        $sql = "SELECT * FROM prodotti WHERE id = $id_prodotto";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $prodotto = $result->fetch_assoc();
            $_SESSION['carrello'][$id_prodotto] = array(
                'nome' => $prodotto['nome'],
                'prezzo' => $prodotto['prezzo'],
                'immagine' => $prodotto['immagine'],
                'quantita' => 1
            );
        }
    }
}

$sql = "SELECT * FROM prodotti";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>Store - Apple</title>
    <link rel="stylesheet" href="catalogo.css">
    <script src="script.js" defer></script>
</head>
<body>
    <nav id="barra"> 
        <a id="logo" href="home.php" ><img src="png-apple-logo-9730.png" alt="Logo" class="logoo"></a>
        <a href="catalogo.php" class="active">Store</a>
        <a>Mac</a><a>iPad</a><a>iPhone</a><a>Watch</a><a>AirPods</a>
        <a>TV & Casa</a><a>Intrattenimento</a><a>Accessori</a><a>Supporto</a>
        <a id="ricerca"><img src="magnifying-glass-308581_640.png" alt="ricerca" class="ricerca"></a>
        <a id="shoppingbag" href="carrello.php" class="shopping-bag-container">
            <img src="Icons8-Ios7-Ecommerce-Shopping-Bag.512.png" alt="shoppingbag" class="shoppingbag">
            <?php if(isset($_SESSION['carrello']) && count($_SESSION['carrello']) > 0): ?>
                <span class="cart-count"><?php echo array_sum(array_column($_SESSION['carrello'], 'quantita')); ?></span>
            <?php endif; ?>
        </a>
    </nav>

    <div class="products-grid">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="product-card">
                    <img src="<?php echo htmlspecialchars($row['immagine']); ?>" alt="<?php echo htmlspecialchars($row['nome']); ?>" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name"><?php echo htmlspecialchars($row['nome']); ?></h3>
                        <p class="product-price">€<?php echo number_format($row['prezzo'], 2); ?></p>
                        <form method="post">
                            <input type="hidden" name="id_prodotto" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="aggiungi_al_carrello" class="add-to-cart">Aggiungi al carrello</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="grid-column: 1 / -1; text-align: center;">Nessun prodotto disponibile nel catalogo.</p>
        <?php endif; ?>
    </div>

    <footer>
        <div id="testofoot">
            <!-- Testo del footer qui, invariato -->
        </div>
    </footer>

<?php $conn->close(); ?>
</body>
</html>
