<?php
require '../config/db.php';
require '../includes/auth.php';

$data = json_decode(file_get_contents("php://input"), true);
$task_id = $data['id'];

if ($_SESSION['role'] === 'admin') {
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([$task_id]);
} else {
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->execute([$task_id, $_SESSION['user_id']]);
}

echo json_encode(["success" => true]);
?>