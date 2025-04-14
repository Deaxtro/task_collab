<?php
require '../config/db.php';
require '../includes/auth.php';

$data = json_decode(file_get_contents("php://input"), true);
$title = $data['title'];
$deadline = $data['deadline'];
$priority = $data['priority'];
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("INSERT INTO tasks (user_id, title, deadline, priority) VALUES (?, ?, ?, ?)");
$stmt->execute([$user_id, $title, $deadline, $priority]);
echo json_encode(["success" => true]);
?>