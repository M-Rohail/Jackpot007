<?php
// Database connection
$servername = "localhost";
$dbusername = "root"; // your DB username
$dbpassword = "";     // your DB password
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
    $countryCode = trim($_POST['countryCode']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit;
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, countryCode, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $countryCode, $phone, $hashedPassword);

    if ($stmt->execute()) {
        // WhatsApp number and message
        $whatsappNumber = "923085382499"; // Your WhatsApp number
        $message = urlencode("Hi, I need ID my username is: $username");

        // Redirect to WhatsApp with pre-filled message
        echo "<script>
            alert('Registered Successfully!');
            window.location.href = 'https://wa.me/$whatsappNumber?text=$message';
        </script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
