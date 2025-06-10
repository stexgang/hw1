<?php
    require_once 'auth.php';

    if (checkAuth()) {
        header("Location: home.php");
        exit;
    }   

    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["name"]) && 
        !empty($_POST["surname"]) && !empty($_POST["confirm_password"]) && !empty($_POST["allow"]))
    {
        $error = array();
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        // USERNAME
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
            $error[] = "ID Apple non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $query = "SELECT username FROM users WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "ID Apple già utilizzato";
            }
        }
        // PASSWORD
        if (strlen($_POST["password"]) < 8) {
            $error[] = "La password deve contenere almeno 8 caratteri";
        } 
        // CONFERMA PASSWORD
        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Le password non corrispondono";
        }
        // EMAIL
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }

        // REGISTRAZIONE NEL DATABASE
        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO users(username, password, name, surname, email) VALUES('$username', '$password', '$name', '$surname', '$email')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["_agora_username"] = $_POST["username"];
                $_SESSION["_agora_user_id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);
    }
    else if (isset($_POST["username"])) {
        $error = array("Compila tutti i campi");
    }
?>

<html>
    <head>
        <link rel='stylesheet' href='signup.css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="apple-favicon.png">
        <meta charset="utf-8">
        <title>Crea il tuo ID Apple</title>
        <style>
            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
                background: #f5f5f7;
                margin: 0;
                padding: 0;
            }
            #logo {
                text-align: left;
                margin-top: 40px;
                margin-bottom: 20px;
            }
            #logo img {
                width: 60px;
            }
            main {
                display: flex;
                justify-content: center;
                align-items: flex-start;
                min-height: 80vh;
            }
            .signup-container {
                background: #fff;
                border-radius: 18px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.08);
                padding: 40px 32px;
                max-width: 400px;
                width: 100%;
            }
            h1 {
                font-size: 2rem;
                font-weight: 600;
                margin-bottom: 24px;
                text-align: center;
                color: #1d1d1f;
            }
            label {
                font-size: 1rem;
                color: #6e6e73;
                font-weight: 500;
            }
            input[type="text"], input[type="password"] {
                width: 100%;
                padding: 12px;
                margin-top: 6px;
                margin-bottom: 18px;
                border: 1px solid #d2d2d7;
                border-radius: 8px;
                font-size: 1rem;
                background: #f5f5f7;
                transition: border 0.2s;
            }
            input[type="text"]:focus, input[type="password"]:focus {
                border: 1.5px solid #0071e3;
                outline: none;
                background: #fff;
            }
            .allow {
                margin-bottom: 18px;
            }
            .allow label {
                font-size: 0.95rem;
                color: #1d1d1f;
                font-weight: 400;
            }
            .submit input[type="submit"] {
                width: 100%;
                background: #0071e3;
                color: #fff;
                border: none;
                border-radius: 8px;
                padding: 14px;
                font-size: 1.1rem;
                font-weight: 600;
                cursor: pointer;
                transition: background 0.2s;
            }
            .submit input[type="submit"]:hover {
                background: #005bb5;
            }
            .errorj {
                background: #fdecea;
                color: #d93025;
                border-radius: 8px;
                padding: 10px 14px;
                margin-bottom: 10px;
                display: flex;
                align-items: center;
                font-size: 0.98rem;
            }
            .errorj img {
                width: 18px;
                margin-right: 8px;
            }
            .signup {
                text-align: center;
                margin-top: 18px;
                font-size: 1rem;
            }
            .signup a {
                color: #0071e3;
                text-decoration: none;
                font-weight: 500;
            }
            .signup a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div id="logo">
            <a href="index.php">
  <img src="Apple_logo_grey.svg.png" alt="Apple Logo">
</a>

            
        </div>
        <main>
        <div class="signup-container">
            <h1>Crea il tuo ID Apple</h1>
            <form name='signup' method='post' enctype="multipart/form-data" autocomplete="off">
                <label for='name'>Nome</label>
                <input type='text' name='name' placeholder="Nome" <?php if(isset($_POST["name"])){echo "value=\"".$_POST["name"]."\"";} ?> >
                
                <label for='surname'>Cognome</label>
                <input type='text' name='surname' placeholder="Cognome" <?php if(isset($_POST["surname"])){echo "value=\"".$_POST["surname"]."\"";} ?> >

                <label for='username'>ID Apple</label>
                <input type='text' name='username' placeholder="ID Apple" <?php if(isset($_POST["username"])){echo "value=\"".$_POST["username"]."\"";} ?>>

                <label for='email'>Email</label>
                <input type='text' name='email' placeholder="indirizzo@email.com" <?php if(isset($_POST["email"])){echo "value=\"".$_POST["email"]."\"";} ?>>

                <label for='password'>Password</label>
                <input type='password' name='password' placeholder="Password" <?php if(isset($_POST["password"])){echo "value=\"".$_POST["password"]."\"";} ?>>

                <label for='confirm_password'>Conferma Password</label>
                <input type='password' name='confirm_password' placeholder="Conferma Password" <?php if(isset($_POST["confirm_password"])){echo "value=\"".$_POST["confirm_password"]."\"";} ?>>

                <div class="allow"> 
                    <input type='checkbox' name='allow' value="1" <?php if(isset($_POST["allow"])){echo $_POST["allow"] ? "checked" : "";} ?>>
                    <label for='allow'>Accetto i termini e condizioni di Apple.</label>
                </div>
                <?php if(isset($error)) {
                    foreach($error as $err) {
                        echo "<div class='errorj'><img src='./assets/close.svg'/><span>".$err."</span></div>";
                    }
                } ?>
                <div class="submit">
                    <input type='submit' value="Crea ID Apple" id="submit">
                </div>
            </form>
            <div class="signup">Hai già un ID Apple? <a href="login.php">Accedi</a></div>
        </div>
        </main>
    </body>
</html>