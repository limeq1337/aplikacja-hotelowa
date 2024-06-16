<?php
$servername = "localhost"; 
$username = "srv64140_bazy"; 
$password = "Jv54ZBp2VCjad9HJET7v"; 
$dbname = "srv64140_bazy"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['login']) && !empty($_POST['pass'])) {
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        

        $login = mysqli_real_escape_string($conn, $login);
        $pass = mysqli_real_escape_string($conn, $pass);
        

        $sql = "SELECT * FROM workers WHERE worker_login = '$login' AND worker_password = '$pass'";
        $result = $conn->query($sql);
        

        if ($result->num_rows > 0) {
            header("Location: view_reservation.php");
            exit();
        } else {

         
            exit();
        }
    } else {

      
        exit();
    }
}

$conn->close();
?>
