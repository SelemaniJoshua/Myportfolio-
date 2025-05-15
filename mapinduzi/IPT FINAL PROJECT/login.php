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

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        function showAlertAndRedirect($message, $url) {
            echo "<script>
                alert('$message');
                window.location.href='$url';
            </script>";
        }
        
        showAlertAndRedirect("Dear costomer you are successfully registered please continue for the payments!", "http://localhost/mapinduzi/IPT%20FINAL%20PROJECT/history.html");
        

        } else {
            function showAlertAndRedirect($message, $url) {
                echo "<script>
                    alert('$message');
                    window.location.href='$url';
                </script>";
            }
            
            showAlertAndRedirect("Your Login is successfully, Welcome to the Admin Records", "http://localhost/mapinduzi/IPT%20FINAL%20PROJECT/history.html");
            

    } 

    $conn->close();

}