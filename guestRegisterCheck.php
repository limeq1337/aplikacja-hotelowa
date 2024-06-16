<?php
$servername = "localhost";
$username = "srv64140_bazy";
$password = "Jv54ZBp2VCjad9HJET7v";
$dbname = "srv64140_bazy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guestLogin = $_POST['guestLogin'];
    $guestPass = $_POST['guestPass'];
    $guestName = $_POST['name'];
    $guestLastName = $_POST['lastName'];
    $guestPesel = $_POST['guestPesel'];
    $guestPhoneNumber = $_POST['guestPhoneNumber'];


    $sqlCheckUser = "SELECT guestLogin FROM guest WHERE guestLogin = ?";
    $stmt = $conn->prepare($sqlCheckUser);
    $stmt->bind_param("s", $guestLogin);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        header("Location: guestRegister.php?error=1");
        exit();
    }
    $stmt->close();


    $result = $conn->query("SELECT MAX(guestId) AS maxGuestId FROM guest");
    $row = $result->fetch_assoc();
    $newGuestId = $row['maxGuestId'] + 1;


    $sqlGuest = "INSERT INTO guest (guestId, guestLogin, guestPass, name, lastName, pesel, phoneNumber)
                 VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sqlGuest);
    $stmt->bind_param("issssss", $newGuestId, $guestLogin, $guestPass, $guestName, $guestLastName, $guestPesel, $guestPhoneNumber);

    if ($stmt->execute() === TRUE) {
        $stmt->close();
        $conn->close();
        header("Location: logreg.php");
    } else {
        $stmt->close();
        $conn->close();
        header("Location: guestRegister.php?error=1");
    }
}
?>
