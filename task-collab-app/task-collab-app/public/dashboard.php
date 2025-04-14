<?php
require '../includes/auth.php';
if ($_SESSION['role'] == 'admin') {
    header('Location: admin.php');
} else {
    header('Location: user.php');
}
exit;
?>