<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=ebankingusers', 'root', '');

if(isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Weiter zu <a href="https://www.youtube.com">internen Bereich</a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }

}
?>

<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <title>Login</title>


</head>
<body>

<?php
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>

<div class="container">

    <h1 class="mt-5 mb-4">Sparkasse</h1>

    <form  id="user" action="?login=1" method="post">

        <div class="row">

            <div class="col-sm-6 form-group">
                <h2>Willkommen</h2>

                <div class ="mb-3">
                    <input type="email"
                           name="email"
                           placeholder="Bitte Benutzer eingeben"


                           required
                    />
                </div>

                <input type="password"
                       name="passswort"
                       placeholder="Bitte Passwort eingeben"

                       required
                />


                <button type="submit">login</button>
                <a href="lib/registrierung.php">Neuen Benutzer anlegen...</a>
                <a href="index.php">Zurücksetzen</a>
            </div>
        </div>

    </form>
</div>


</body>
</html>