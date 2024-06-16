<?php
$servername = "localhost";
$username = "srv64140_bazy";
$password = "Jv54ZBp2VCjad9HJET7v";
$dbname = "srv64140_bazy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if (!isset($_SESSION['guestLogin'])) {
    header("Location: index.php");
    exit();
}

$guestLogin = $_SESSION['guestLogin'];

$sqlFetchUser = "SELECT guestId, name, lastName FROM guest WHERE guestLogin = '$guestLogin'";
$result = $conn->query($sqlFetchUser);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $guestId = $user['guestId'];
    $guestName = $user['name'];
    $guestLastName = $user['lastName'];
} else {
    echo "Błąd: Nie można znaleźć danych użytkownika.";
    exit();
}

$reservationDetails = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['stayId'])) {
        $stayId = $_POST['stayId'];
        $stayPeriod = $_POST['stayPeriod'];
        $location = $_POST['location'];
        $feedingOption = $_POST['feedingOption'];
        $roomType = $_POST['roomType'];
        $standard = $_POST['standard'];
        $hotelName = $_POST['hotelName'];

        $roomNumber = 101; 
        $date = date('Y-m-d'); 
        $price = 100; 

 
        $sqlCheckReservation = "SELECT * FROM reservation WHERE stayPeriod = '$stayPeriod' AND location = '$location' AND roomType = '$roomType' AND standard = '$standard'";
        $resultCheck = $conn->query($sqlCheckReservation);

        if ($resultCheck->num_rows > 0) {
            echo '<script>alert("Ten termin jest już zajęty, wybierz inny"); window.location.href = "gosc2.php";</script>';
        } else {
        
            $resultRoom = $conn->query("SELECT roomNumber FROM rooms WHERE roomNumber = '$roomNumber'");
            if ($resultRoom->num_rows == 0) {
                $sqlRoom = "INSERT INTO rooms (roomNumber, guestLimit, standard, isAvailable) VALUES ('$roomNumber', '2', '$standard', '1')";
                $conn->query($sqlRoom);
            }

         
            $result = $conn->query("SELECT MAX(reservationId) AS maxReservationId FROM reservation");
            $row = $result->fetch_assoc();
            $newReservationId = $row['maxReservationId'] + 1;


            $sqlReservation = "INSERT INTO reservation (reservationId, guestId, guestLogin, name, lastName, roomNumber, date, price, feedingOption, stayId, stayPeriod, location, roomType, standard, hotelName)
                               VALUES ('$newReservationId', '$guestId', '$guestLogin', '$guestName', '$guestLastName', '$roomNumber', '$date', '$price', '$feedingOption', '$stayId', '$stayPeriod', '$location', '$roomType', '$standard', '$hotelName')";

            if ($conn->query($sqlReservation) === TRUE) {
    
                $reservationDetails = "
                    <h1>Podsumowanie rezerwacji</h1>
                    Reservation ID: $newReservationId<br>
                    Guest ID: $guestId<br>
                    Guest Login: $guestLogin<br>
                    Guest Name: $guestName<br>
                    Guest Lastname: $guestLastName<br>
                    Room Number: $roomNumber<br>
                    Date: $date<br>
                    Price: $price<br>
                    Feeding Option: $feedingOption<br>
                    Stay ID: $stayId<br>
                    Stay Period: $stayPeriod<br>
                    Location: $location<br>
                    Room Type: $roomType<br>
                    Standard: $standard<br>
                    Hotel Name: $hotelName
                ";

   
                $_SESSION['reservationDetails'] = $reservationDetails;

       
                header("Location: send_email.php");
                exit();
            } else {
                echo "Błąd: " . $sqlReservation . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
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
            <?php if (!empty($reservationDetails)): ?>
            
                    <?php echo $reservationDetails; ?>

            <?php endif; ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="email">Podaj e-mail, na który mają zostać wysłane informacje o rezerwacji:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary">Wyślij</button>
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
