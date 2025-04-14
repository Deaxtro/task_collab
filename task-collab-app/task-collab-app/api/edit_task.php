<?php
require '../config/db.php';
require '../includes/auth.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$title = $data['title'];
$deadline = $data['deadline'];
$priority = $data['priority'];

$stmt = $pdo->prepare("UPDATE tasks SET title = ?, deadline = ?, priority = ? WHERE id = ? AND user_id = ?");
$stmt->execute([$title, $deadline, $priority, $id, $_SESSION['user_id']]);
echo json_encode(["success" => true]);
?>