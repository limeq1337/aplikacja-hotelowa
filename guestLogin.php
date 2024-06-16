<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Aplikacja hotelowa</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col" id="workerform">
                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                if(isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if($error == 1) {
                        echo '<div class="alert alert-danger" role="alert">Nieprawidłowa nazwa użytkownika lub hasło.</div>';
                    } elseif($error == 2) {
                        echo '<div class="alert alert-danger" role="alert">Wprowadź nazwę użytkownika i hasło.</div>';
                    }
                }
                ?>
                <form method="POST" action="guestLoginCheck.php">
                    <div class="form-group">
                        <label for="username">Nazwa użytkownika:</label>
                        <input type="text" class="form-control" id="guestLogin" name="guestLogin" placeholder="Login">
                    </div>
                    <div class="form-group">
                        <label for="password">Hasło:</label>
                        <input type="password" class="form-control" id="guestPass" name="guestPass" placeholder="Hasło">
                    </div>
                    <button type="submit" class="workerbut text-center btn">Zaloguj się</button>
                </form>
                <br>
                <a href="index.php"><button class="workerbut text-center btn">Wróć do początku</button></a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
