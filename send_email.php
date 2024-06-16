<?php
session_start();

if (!isset($_SESSION['reservationDetails'])) {
    header("Location: index.php"); 
    exit();
}

$reservationDetails = $_SESSION['reservationDetails'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'])) {
        $to = $_POST['email'];
        $subject = "Informacje o rezerwacji";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <noreply@aplikacjahotelowa>' . "\r\n";

        if (mail($to, $subject, $reservationDetails, $headers)) {
            echo '<script>alert("Informacje o rezerwacji zostały wysłane na podany adres e-mail.");</script>';
        } else {
            error_log("Error: Failed to send email to $to."); 
            echo '<script>alert("Wystąpił błąd podczas wysyłania e-maila.");</script>';
        }

        unset($_SESSION['reservationDetails']); 
    }
}
?>
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
        <div class="col" id="trivago">
            <h1 id="maintext">Rezerwacja została złożona pomyślnie!</h1>
            <div class="reservation-details">
                <?php echo $reservationDetails; ?>
            </div>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="email">Podaj e-mail, na który mają zostać wysłane informacje o rezerwacji:</label>
                    <input type="email" class="m-auto form-control text-center" id="email" name="email" required style="width:20%; text-align:center;">
                </div>
                <button type="submit" class="workerbut text-center btn search">Wyślij</button>
            </form>
            <br><a href="index.php"><button class="workerbut text-center btn search">Wróć do początku</button></a>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
