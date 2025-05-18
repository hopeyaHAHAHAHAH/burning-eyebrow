<?php
// Database connection details
$host = "localhost";
$user = "root";
$password = "";
$db = "study_tracker";

// Create connection
$conn = new mysqli($host, $user, $password, $db);

// Check if the connection was successful
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Get JSON input from the client
$data = json_decode(file_get_contents("php://input"), true);

// Check if 'username' is provided
if (!isset($data['username'])) {
    echo json_encode(["error" => "Username is required."]);
    exit;
}

$username = $data['username'];

// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT * FROM logs WHERE username=? ORDER BY date DESC");
if (!$stmt) {
    echo json_encode(["error" => "Query preparation failed: " . $conn->error]);
    exit;
}

$stmt->bind_param("s", $username);
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if there are logs
$logs = [];
while ($row = $result->fetch_assoc()) {
    $logs[] = $row;
}

// If no logs are found, return a message
if (empty($logs)) {
    echo json_encode(["message" => "No logs found for this user."]);
} else {
    // Return logs as a JSON response
    echo json_encode($logs);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
