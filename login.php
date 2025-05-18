<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "study_tracker";

$conn = new mysqli($host, $user, $password, $db);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read the incoming data from the POST request
$data = json_decode(file_get_contents("php://input"), true);
$username = $conn->real_escape_string($data["username"]);
$passwordPlain = $data["password"];

// Query the database to get the user data
$res = $conn->query("SELECT * FROM users WHERE username='$username'");
$user = $res->fetch_assoc();

if ($user && password_verify($passwordPlain, $user["password"])) {
    // Successful login: start a session and store user_id in the session
    session_start();
    $_SESSION['user_id'] = $user['id'];  // Store the user ID in session
    
    // Optionally, you can store the username too, depending on your needs
    $_SESSION['username'] = $user['username'];

    // Return success response
    echo json_encode([
        "status" => "success",
        "username" => $username,
        "message" => "Login successful!"
    ]);
} else {
    // Invalid credentials: return an error response
    echo json_encode([
        "status" => "error",
        "message" => "Invalid credentials"
    ]);
}

// Close the database connection
$conn->close();
?>
