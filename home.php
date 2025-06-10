<?php
require_once 'auth.php';
if (!$userid = checkAuth()) {
    header("Location: login.php");
    exit;
}

require_once 'dbconfig.php'; 

$userid = $conn->real_escape_string($userid);

$query = "SELECT * FROM users WHERE id = $userid";
$res_1 = $conn->query($query);

if (!$res_1) {
    die("Query fallita: " . $conn->error);
}

$userinfo = $res_1->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="hw1.css">
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>


  <html>
    <head> 
        <link rel="stylesheet" href="hw1.css">
        <meta charset ="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <nav id="barra"> 
            <a id="logo"> 
            <img src="png-apple-logo-9730.png" alt="Logoo" class="logoo"> 
            </a>
            <a href="catalogo.php">Store</a>
            <a>Mac</a>
            <a>iPad</a>
            <a>iPhone</a>
            <a>Watch</a>
            <a>AirPods</a>
            <a>TV & Casa</a>
            <a>Intrattenimento</a>
            <a>Accessori</a>
            <a>Supporto</a>
            <a id="ricerca"><img src="magnifying-glass-308581_640.png" alt="ricerca" class="ricerca"></a>
            <a id="shoppingbag" href="carrello.php"><img src="Icons8-Ios7-Ecommerce-Shopping-Bag.512.png" alt="shoppingbag" class="shoppingbag"></a>
        </nav>
      <div id="flexbox">
        <div id="immagine"><img src="hero_static__c9sislzzicq6_large.png"alt="macc" class="macc"></div><p>MacBook Air</p>
        <div id="testo1">Colore celeste</div>
        <div id="testo2">E prestazioni celestiali,con M4</div>
        <div id="flex2">
            <div id="box1">Scopri di più</div>
            <div id="box2">Acquista</div>
        </div>


    </div>
    <div id="flexbox2">
        <div id="testo02">iPhone 16</div>
        <div id="testo03">Progettato per Apple Intelligence.</div>
        <div id="immaginee">   <img src="iphone-16-pro-whitetitanium-select.png"alt="iphone" class="iphone"></div>
        <div id="flex3">
            <div id="box01">Scopri di più</div>
            <div id="box02">Acquista</div>
        </div>
    </div>
    <div id="flexbox3">
        <div id="testo04">AirPods 4</div>
        <div id="testo05">Con cancellazione attiva del rumore.</div>
        <div id="immagineee">   <img src="121204-airpods-4-anc.png"alt="airpods" class="airpods"></div>
        <div id="flex4">
            <div id="box001">Scopri di più</div>
            <div id="box002">Acquista</div>
</div>

<script src="home.js"></script>

        </div>

    </body>
    <footer>
        <div id="testofoot">1. Apple Intelligence è disponibile in versione beta su tutti i modelli di iPhone 16, su iPhone 15 Pro e iPhone 15 Pro Max, su iPad mini (A17 Pro) e sui modelli di iPad e Mac con chip M1 e successivi, impostando Siri e la lingua del dispositivo su inglese (Australia, Canada, Irlanda, Nuova Zelanda, Regno Unito, Stati Uniti o Sudafrica), come parte di un aggiornamento software di iOS 18, iPadOS 18 e macOS Sequoia. Da inizio aprile saranno disponibili ulteriori funzioni e il supporto per cinese (semplificato), coreano, francese, giapponese, inglese (India, Singapore), italiano, portoghese (Brasile), spagnolo e tedesco; altre lingue, tra cui il vietnamita, arriveranno nei mesi successivi. Alcune funzioni potrebbero non essere disponibili in tutte le aree geografiche o in tutte le lingue.
            
            2. Disponibili in due modelli: AirPods 4 e AirPods 4 con cancellazione attiva del rumore.
            <br><br>
            3. Il valore di permuta dipende dalle condizioni, dall’anno di fabbricazione e dalla configurazione del dispositivo che restituisci. Per usufruire della permuta in cambio di una Apple Gift Card o di un credito devi avere compiuto almeno 18 anni. Non tutti i dispositivi danno diritto a ricevere un credito. Per maggiori dettagli sulla permuta dei dispositivi idonei puoi rivolgerti al nostro partner. Il servizio potrebbe essere soggetto a restrizioni e limitazioni. Il pagamento avverrà solo se il dispositivo ricevuto corrisponde alla descrizione fornita al momento della valutazione. Apple si riserva il diritto di rifiutare la permuta o limitarne la quantità per qualsiasi dispositivo e per qualsivoglia motivo. Il valore del tuo vecchio dispositivo potrà essere riconosciuto a fronte dell’acquisto di un nuovo dispositivo Apple. L’offerta potrebbe non essere disponibile in tutti gli Store. La permuta di computer desktop (computer fisso) è attualmente disponibile solo online e alcuni Apple Store potrebbero applicare restrizioni aggiuntive.
            Apple TV+ richiede un abbonamento.
            Le funzioni descritte possono subire modifiche. Alcune funzioni e applicazioni e alcuni servizi potrebbero non essere disponibili in tutte le aree geografiche o in tutte le lingue.</div>
    </footer>
    
</html>