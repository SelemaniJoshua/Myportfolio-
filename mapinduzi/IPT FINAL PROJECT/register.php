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
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $address = $_POST['address'];

    // Check if username or email already exists
    $checkUser = $conn->prepare("SELECT * FROM customers WHERE username = ? OR email = ?");
    $checkUser->bind_param("ss", $username, $email);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows > 0) {
        function showAlertAndRedirect($message, $url) {
            echo "<script>
                alert('$message');
                window.location.href='$url';
            </script>";
        }
        
        showAlertAndRedirect("Dear costomer the username or email already exist please login!", "http://localhost/mapinduzi/IPT%20FINAL%20PROJECT/log.html");
        
    } else {
        $sql = $conn->prepare("INSERT INTO customers (username, email, password, phone, location, address) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssssss", $username, $email, $password, $phone, $location, $address);

        if ($sql->execute() === TRUE) {
            function showAlertAndRedirect($message, $url) {
                echo "<script>
                    alert('$message');
                    window.location.href='$url';
                </script>";
            }
            
            showAlertAndRedirect("Dear costomer you are successfully registered please continue for the payments!", "http://localhost/mapinduzi/IPT%20FINAL%20PROJECT/transaction.html");
            
        } else {
            echo "Error: " . $sql->error;
        }
    }

    $conn->close();
}
?>
