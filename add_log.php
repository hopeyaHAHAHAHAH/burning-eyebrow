<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "study_tracker";

// Create connection
$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validate required fields
$required = ["username", "date", "studyTime", "breakTime", "sessions", "streak"];
foreach ($required as $field) {
    if (!isset($data[$field])) {
        echo json_encode(["error" => "$field is required."]);
        exit;
    }
}

// Assign values
$username   = $data["username"];
$date       = $data["date"];
$studyTime  = $data["studyTime"];
$breakTime  = $data["breakTime"];
$sessions   = $data["sessions"];
$streak     = $data["streak"];

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO logs (username, date, studyTime, breakTime, sessions, streak) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    echo json_encode(["error" => "Preparation failed: " . $conn->error]);
    exit;
}

// Bind parameters and execute
$stmt->bind_param("ssiiii", $username, $date, $studyTime, $breakTime, $sessions, $streak);

if ($stmt->execute()) {
    echo json_encode(["success" => "Log entry added successfully."]);
} else {
    echo json_encode(["error" => "Execution failed: " . $stmt->error]);
}

// Close connection
$stmt->close();
$conn->close();
?>
