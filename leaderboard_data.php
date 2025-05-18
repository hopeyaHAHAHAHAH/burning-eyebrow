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

$filter = $_GET['filter'] ?? 'studytime'; // Default filter

$validFilters = ['studytime', 'breaktime', 'sessions', 'streak'];

if (!in_array($filter, $validFilters)) $filter = 'studytime';

$query = "
    SELECT 
        logs.username,
        SUM(logs.studytime) AS total_study_time,
        SUM(logs.breaktime) AS total_break_time,
        SUM(logs.sessions) AS total_sessions,
        SUM(logs.streak) AS total_streak
    FROM logs
    GROUP BY logs.username
";

// Sorting
switch ($filter) {
    case 'breaktime':
        $query .= " ORDER BY total_break_time DESC";
        break;
    case 'sessions':
        $query .= " ORDER BY total_sessions DESC";
        break;
    case 'streak':
        $query .= " ORDER BY total_streak DESC";
        break;
    default:
        $query .= " ORDER BY total_study_time DESC";
}

$result = mysqli_query($conn, $query);

$leaderboard = [];
$rank = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $leaderboard[] = [
        'rank' => $rank++,
        'username' => $row['username'],
        'studytime' => $row['total_study_time'],
        'breaktime' => $row['total_break_time'],
        'sessions' => $row['total_sessions'],
        'streak' => $row['total_streak'] // <== changed to total_streak
    ];
}

echo json_encode($leaderboard);
