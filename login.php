<?php
session_start();  

include 'auth.php';


if (checkAuth()) {
    header('Location: index.php');
    exit;
}

require_once 'dbconfig.php';  

if (!empty($_POST["username"]) && !empty($_POST["password"])) {
   

    $username = $conn->real_escape_string($_POST['username']);

    $query = "SELECT * FROM users WHERE username = '$username'";
    $res = $conn->query($query);

    if ($res && $res->num_rows > 0) {
        $entry = $res->fetch_assoc();

        if (password_verify($_POST['password'], $entry['password'])) {
            
            $_SESSION["_agora_username"] = $entry['username'];
            $_SESSION["_agora_user_id"] = $entry['id'];

            header("Location: home.php");
            $res->free();
            $conn->close();
            exit;
        }
    }

    $error = "Username e/o password errati.";
} else if (isset($_POST["username"]) || isset($_POST["password"])) {
    $error = "Inserisci username e password.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel='stylesheet' href='login.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accedi - Apple</title>
</head>
<body>
    <div id="logo">
        <a href="index.php" style="display: flex; justify-content: center; align-items: center;">
            <img src="Apple_logo_grey.svg.png" alt="Apple Logo" style="height:100px; display: block; margin: 0 auto;">
        </a>
    </div>
    <main class="login">
        <section class="main">
            <h5>Per continuare, accedi ad Apple.</h5>
            <?php if (isset($error)) {
                echo "<p class='error'>$error</p>";
            } ?>
            <form name='login' method='post'>
                <div class="username">
                    <label for='username'>Username</label>
                    <input type='text' name='username' <?php if(isset($_POST["username"])) echo "value='".htmlspecialchars($_POST["username"], ENT_QUOTES)."'"; ?>>
                </div>
                <div class="password">
                    <label for='password'>Password</label>
                    <input type='password' name='password'>
                </div>
                <div class="submit-container">
                    <div class="login-btn">
                        <input type='submit' value="ACCEDI">
                    </div>
                </div>
            </form>
            <div class="signup"><h4>Non hai un account?</h4></div>
            <div class="signup-btn-container"><a class="signup-btn" href="signup.php">ISCRIVITI AD APPLE</a></div>
        </section>
    </main>
</body>
</html>
