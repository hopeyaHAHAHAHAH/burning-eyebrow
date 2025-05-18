<?php
session_start();

// Assuming you have a session with the user ID or username already set
if (isset($_SESSION['user_id'])) {
    // Connect to your database using PDO or MySQLi
    $conn = new mysqli("localhost", "your_username", "your_password", "your_database");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the username from the database
    $userId = $_SESSION['user_id'];
    $sql = "SELECT username FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['username' => $row['username']]);
    } else {
        echo json_encode(['username' => 'User!']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['username' => 'User!']);
}
?>
