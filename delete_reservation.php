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
            <div class="col">
            <h1 id="maintext">Aplikacja Hotelowa</h1>
            <h2>Lista rezerwacji</h2>
            <?php
$servername = "localhost"; 
$username = "srv64140_bazy"; 
$password = "Jv54ZBp2VCjad9HJET7v"; 
$dbname = "srv64140_bazy"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}
error_reporting(E_ALL);
ini_set('display_errors', 1);


if (isset($_GET['id'])) {
    $reservationId = $_GET['id'];

    $sqlDelete = "DELETE FROM reservation WHERE reservationId = '$reservationId'";

    if ($conn->query($sqlDelete) === TRUE) {
        echo "Rezerwacja została usunięta pomyślnie.";
    } else {
        echo "Error deleting reservation: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>






<br><a href="view_reservation.php"><button class="workerbut text-center btn ">Wróć do listy</button></a>
                <br><a href="index.php"><button class="workerbut text-center btn ">Wróć do początku</button></a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>


