<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['login']) && !empty($_POST['pass'])) {
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        
    
        $login = mysqli_real_escape_string($conn, $login);
        $pass = mysqli_real_escape_string($conn, $pass);
        
        $sql = "SELECT * FROM workers WHERE worker_login = '$login' AND worker_password = '$pass'";
        $result = $conn->query($sql);
        

        if ($result->num_rows == 1) {

            header("Location: view_reservation.php?login=" . urlencode($login));
            exit();
        } else {

           echo 'błędne dane';
            exit();
        }
    } else {

        header("Location: index.php?error=2");
        exit();
    }
} else {

    header("Location: index.php");
    exit();
}

$conn->close();
?>
