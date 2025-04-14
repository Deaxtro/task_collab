<?php
require '../config/db.php';
require '../includes/auth.php';

if ($_SESSION['role'] === 'admin') {
    $stmt = $pdo->query("SELECT tasks.*, users.name FROM tasks JOIN users ON tasks.user_id = users.id ORDER BY tasks.deadline");
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY deadline");
    $stmt->execute([$_SESSION['user_id']]);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

echo json_encode($tasks);
?>