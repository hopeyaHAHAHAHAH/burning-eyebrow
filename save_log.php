<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "study_tracker";

$conn = new mysqli($host, $user, $password, $db);
header("Content-Type: application/json");

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'];
$date = $data['date'];
$studytime = (int)$data['studytime'];
$breaktime = (int)$data['breaktime'];

if (!$username || !$date) {
    echo json_encode(['success' => false, 'error' => 'Missing data']);
    exit;
}

// Check if log exists for today
$sql = "SELECT * FROM logs WHERE username = ? AND date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update existing log
    $update = "UPDATE logs SET 
                studytime = studytime + ?,
                breaktime = breaktime + ?,
                sessions = sessions + 1,
                streak = 1
               WHERE username = ? AND date = ?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("iiss", $studytime, $breaktime, $username, $date);
    $success = $stmt->execute();
} else {
    // Insert new log with actual input values
    $insert = "INSERT INTO logs (username, date, studytime, breaktime, sessions, streak)
               VALUES (?, ?, ?, ?, 1, 1)";
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("ssii", $username, $date, $studytime, $breaktime);
    $success = $stmt->execute();
}

if ($success) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

$conn->close();
