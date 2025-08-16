<?php
// Database connection
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "jackpot_db";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Prepare statement to fetch user
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            // Login successful, redirect to WhatsApp
            $whatsappNumber = "923085382499"; // Your WhatsApp number
            $message = urlencode("Hi, I need ID my username is: $username");

            echo "<script>
                alert('Login Successful!');
                window.location.href = 'https://wa.me/$whatsappNumber?text=$message';
            </script>";
        } else {
            echo "<script>alert('Incorrect password!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Username not found!'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
