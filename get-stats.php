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

// Get user's total stats
$sql = "SELECT 
            SUM(studytime) AS total_study_time,
            SUM(sessions) AS total_sessions,
            SUM(streak) AS current_streak
        FROM logs
        WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$stats = $result->fetch_assoc();

$total_study_time = $stats['total_study_time'] ?? 0;
$total_sessions = $stats['total_sessions'] ?? 0;
$current_streak = $stats['current_streak'] ?? 0;

// Get achievements user already unlocked
$unlockedAchievements = [];
$sql = "SELECT achievement_id FROM user_achievements WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $unlockedAchievements[] = $row['achievement_id'];
}

// Get all achievements
$sql = "SELECT * FROM achievements";
$result = $conn->query($sql);

$newlyUnlocked = [];

while ($achievement = $result->fetch_assoc()) {
    $achId = $achievement['id'];
    $type = $achievement['condition_type'];
    $value = $achievement['condition_value'];

    $userValue = 0;
    if ($type == 'studytime') $userValue = $total_study_time;
    if ($type == 'sessions') $userValue = $total_sessions;
    if ($type == 'streak') $userValue = $current_streak;

    if ($userValue >= $value && !in_array($achId, $unlockedAchievements)) {
        // Unlock achievement
        $stmt = $conn->prepare("INSERT INTO user_achievements (username, achievement_id) VALUES (?, ?)");
        $stmt->bind_param("si", $username, $achId);
        $stmt->execute();

        $newlyUnlocked[] = [
            'name' => $achievement['name'],
            'description' => $achievement['description'],
            'icon' => $achievement['icon']
        ];
    }
}

echo json_encode([
    'newlyUnlocked' => $newlyUnlocked,
    'totalTime' => $total_study_time,
    'sessions' => $total_sessions,
    'streak' => $current_streak
]);
?>
