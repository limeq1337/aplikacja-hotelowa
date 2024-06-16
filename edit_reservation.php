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
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost"; 
$username = "srv64140_bazy"; 
$password = "Jv54ZBp2VCjad9HJET7v"; 
$dbname = "srv64140_bazy"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}


if (!$conn || $conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservationId = $_POST['reservationId'];
    $guestId = $_POST['guestId'];
    $guestLogin = $_POST['guestLogin'];
    $name = $_POST['name'];
    $lastName = $_POST['lastName'];
    $roomNumber = $_POST['roomNumber'];
    $date = $_POST['date'];
    $price = $_POST['price'];
    $feedingOption = $_POST['feedingOption'];
    $stayId = $_POST['stayId'];
    $stayPeriod = $_POST['stayPeriod'];
    $location = $_POST['location'];
    $roomType = $_POST['roomType'];
    $standard = $_POST['standard'];
    $hotelName = $_POST['hotelName'];

    $sql = "UPDATE reservation SET 
            guestId='$guestId', guestLogin='$guestLogin', name='$name', lastName='$lastName', 
            roomNumber='$roomNumber', date='$date', price='$price', feedingOption='$feedingOption', 
            stayId='$stayId', stayPeriod='$stayPeriod', location='$location', 
            roomType='$roomType', standard='$standard', hotelName='$hotelName' 
            WHERE reservationId='$reservationId'";

    if ($conn->query($sql) === TRUE) {
        echo "Rezerwacja została zmieniona pomyślnie.";
    } else {
        echo "Error updating reservation: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $reservationId = $_GET['id'];
    $sql = "SELECT * FROM reservation WHERE reservationId = '$reservationId'";
    $result = $conn->query($sql);


    if ($result === false) {
        die("Error executing query: " . $conn->error);
    } else {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="post" action="">
                <input type="hidden" name="reservationId" value="<?php echo $row['reservationId']; ?>">
                Guest ID: <input type="text" name="guestId" value="<?php echo $row['guestId']; ?>"><br>
                Guest Login: <input type="text" name="guestLogin" value="<?php echo $row['guestLogin']; ?>"><br>
                Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
                Last Name: <input type="text" name="lastName" value="<?php echo $row['lastName']; ?>"><br>
                Room Number: <input type="text" name="roomNumber" value="<?php echo $row['roomNumber']; ?>"><br>
                Date: <input type="date" name="date" value="<?php echo $row['date']; ?>"><br>
                Price: <input type="text" name="price" value="<?php echo $row['price']; ?>"><br>
                Feeding Option: <input type="text" name="feedingOption" value="<?php echo $row['feedingOption']; ?>"><br>
                Stay ID: <input type="text" name="stayId" value="<?php echo $row['stayId']; ?>"><br>
                Stay Period: <input type="text" name="stayPeriod" value="<?php echo $row['stayPeriod']; ?>"><br>
                Location: <input type="text" name="location" value="<?php echo $row['location']; ?>"><br>
                Room Type: <input type="text" name="roomType" value="<?php echo $row['roomType']; ?>"><br>
                Standard: <input type="text" name="standard" value="<?php echo $row['standard']; ?>"><br>
                Hotel Name: <input type="text" name="hotelName" value="<?php echo $row['hotelName']; ?>"><br>
                <button type="submit" value="Zmień" class="workerbut text-center btn">Zmień</button>
            </form>
            <?php
        } else {
            echo "Reservation not found.";
        }
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


