<?php
session_start();


if (isset($_POST['rimuovi'])) {
    $id = $_POST['id_prodotto'];
    unset($_SESSION['carrello'][$id]);
}


if (isset($_POST['aggiorna'])) {
    $id = $_POST['id_prodotto'];
    $quantita = max(1, intval($_POST['quantita']));
    $_SESSION['carrello'][$id]['quantita'] = $quantita;
}


function calcolaTotale($carrello) {
    $totale = 0;
    foreach ($carrello as $item) {
        $totale += $item['prezzo'] * $item['quantita'];
    }
    return $totale;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>Carrello - Apple Store</title>
    <link rel="stylesheet" href="catalogo.css">
</head>
<body>
    <nav id="barra"> 
        <a id="logo" href="home.php"><img src="png-apple-logo-9730.png" alt="Logo" class="logoo"></a>
        <a href="catalogo.php">Store</a>
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

    <div class="carrello-container">
        <h1>Il tuo carrello</h1>

        <?php if (isset($_SESSION['carrello']) && count($_SESSION['carrello']) > 0): ?>
            <table class="carrello-tabella">
                <thead>
                    <tr>
                        <th>Prodotto</th>
                        <th>Prezzo</th>
                        <th>Quantità</th>
                        <th>Subtotale</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['carrello'] as $id => $item): ?>
                        <tr>
                            <td>
                                <img src="<?php echo htmlspecialchars($item['immagine']); ?>" alt="<?php echo htmlspecialchars($item['nome']); ?>" class="product-image-small">
                                <?php echo htmlspecialchars($item['nome']); ?>
                            </td>
                            <td>€<?php echo number_format($item['prezzo'], 2); ?></td>
                            <td>
                                <form method="post" style="display:inline-block;">
                                    <input type="hidden" name="id_prodotto" value="<?php echo $id; ?>">
                                    <input type="number" name="quantita" value="<?php echo $item['quantita']; ?>" min="1" style="width: 60px;">
                                    <button type="submit" name="aggiorna">Aggiorna</button>
                                </form>
                            </td>
                            <td>€<?php echo number_format($item['prezzo'] * $item['quantita'], 2); ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="id_prodotto" value="<?php echo $id; ?>">
                                    <button type="submit" name="rimuovi">Rimuovi</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="totale-carrello">
                <h3>Totale: €<?php echo number_format(calcolaTotale($_SESSION['carrello']), 2); ?></h3>
                <a href="#" class="checkout-btn">Procedi al pagamento</a>
            </div>
        <?php else: ?>
            <p>Il tuo carrello è vuoto.</p>
        <?php endif; ?>
    </div>

    <footer>
        <div id="testofoot">
            
        </div>
    </footer>
</body>
</html>
