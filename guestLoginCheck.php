<?php
$servername = "localhost"; 
$username = "srv64140_bazy"; 
$password = "Jv54ZBp2VCjad9HJET7v"; 
$dbname = "srv64140_bazy"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}



session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['guestLogin']) && !empty($_POST['guestPass'])) {
        $login = $_POST['guestLogin'];
        $pass = $_POST['guestPass'];
        
        $login = mysqli_real_escape_string($conn, $login);
        $pass = mysqli_real_escape_string($conn, $pass);
        
        $sql = "SELECT * FROM guest WHERE guestLogin = '$login' AND guestPass = '$pass'";
        $result = $conn->query($sql);
        
        if ($result->num_rows == 1) {
      
            $_SESSION['guestLogin'] = $login; 
            
            header("Location: gosc2.php");
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
