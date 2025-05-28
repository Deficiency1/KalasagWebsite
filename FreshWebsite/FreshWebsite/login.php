<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        echo "✅ Login successful! Welcome, " . htmlspecialchars($user['username']) . ".";
    } else {
        echo "❌ Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>