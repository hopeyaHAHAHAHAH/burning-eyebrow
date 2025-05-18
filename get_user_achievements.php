<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "study_tracker";

$conn = new mysqli($host, $user, $password, $db);
header("Content-Type: application/json");

if (!isset($_SESSION['username'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$username = $_SESSION['username'];

// Get user stats (using studytime & breaktime)
$stats_sql = "SELECT 
                SUM(studytime) AS total_study_time,
                SUM(breaktime) AS total_break_time,
                SUM(sessions) AS total_sessions,
                SUM(streak) AS current_streak
              FROM logs
              WHERE username = ?";
$stmt = $conn->prepare($stats_sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user_stats = $result->fetch_assoc();

// Get today's breaks count
$today_breaks_sql = "SELECT COUNT(*) AS today_breaks 
                     FROM logs 
                     WHERE username = ? AND DATE(date) = CURDATE() AND breaktime > 0";
$stmt = $conn->prepare($today_breaks_sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$today_breaks = $stmt->get_result()->fetch_assoc()['today_breaks'] ?? 0;

// Calculate additional break stats
$break_stats_sql = "SELECT 
                        AVG(breaktime) AS avg_break_time,
                        MAX(breaktime) AS max_break_duration,
                        COUNT(CASE WHEN breaktime > 0 THEN 1 END) AS total_breaks
                    FROM logs
                    WHERE username = ?";
$stmt = $conn->prepare($break_stats_sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$break_stats = $stmt->get_result()->fetch_assoc();

// Get all achievements
$ach_sql = "SELECT a.id, a.name, a.description, a.icon, a.condition_type, a.condition_value,
                   IF(ua.achievement_id IS NULL, 0, 1) AS unlocked,
                   ua.unlocked_at
            FROM achievements a
            LEFT JOIN user_achievements ua ON a.id = ua.achievement_id AND ua.username = ?
            ORDER BY unlocked DESC, a.id ASC";
$stmt = $conn->prepare($ach_sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$achievements = [];
while ($row = $result->fetch_assoc()) {
    $progress = 0;
    $current = 0;

    switch ($row['condition_type']) {
        case 'sessions':
            $current = $user_stats['total_sessions'] ?? 0;
            break;
        case 'streak':
            $current = $user_stats['current_streak'] ?? 0;
            break;
        case 'studytime':
            $current = $user_stats['total_study_time'] ?? 0;
            break;
        case 'break_vs_study':
            $current = ($user_stats['total_break_time'] ?? 0) >= ($user_stats['total_study_time'] ?? 0) ? 1 : 0;
            break;
        case 'break_count_daily':
            $current = $today_breaks;
            break;
        case 'break_duration':
            $current = $break_stats['max_break_duration'] ?? 0;
            break;
        case 'average_break_time':
            $current = $break_stats['avg_break_time'] ?? 0;
            break;
        case 'total_breaks':
            $current = $break_stats['total_breaks'] ?? 0;
            break;
    }

    $progress = min(100, ($current / $row['condition_value']) * 100);

    $row['progress'] = $progress;
    $row['current_value'] = $current;

    $achievements[] = $row;
}

echo json_encode(['achievements' => $achievements]);
?>
