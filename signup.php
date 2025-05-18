<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "study_tracker";

$conn = new mysqli($host, $user, $password, $db);

$data = json_decode(file_get_contents("php://input"), true);
$username = $conn->real_escape_string($data["username"]);
$passwordPlain = $data["password"];
$hashedPassword = password_hash($passwordPlain, PASSWORD_DEFAULT);

$check = $conn->query("SELECT * FROM users WHERE username='$username'");
if ($check->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Username already exists"]);
    exit;
}

$conn->query("INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')");
echo json_encode(["status" => "success"]);
$conn->close();
?>
