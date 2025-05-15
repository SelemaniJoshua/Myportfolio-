<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = $conn->prepare("SELECT * FROM customers WHERE username = ?");
    $sql->bind_param("$s", $username);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            function showAlertAndRedirect($message, $url) {
                echo "<script>
                    alert('$message');
                    window.location.href='$url';
                </script>";
            }
            
            showAlertAndRedirect("Dear costomer your login is successfully please continue for the payments!", "http://localhost/mapinduzi/IPT%20FINAL%20PROJECT/transaction.html");
        
            } else {
                echo "Invalid password. Please enter the valid informations...";
                header("refresh:3;url=log.html");
            }
        } else {
            echo "No user found. Please enter some valid informations...";
            header("refresh:3;url=log.html");
        }
        }
    $conn->close();

?>
