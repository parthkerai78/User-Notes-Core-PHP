<?php
    require_once "config/database.php";

    $db = new Database();
    $conn = $db->connect();

    $id = $_GET['id'];

    $query = "DELETE FROM notes WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);

    header ("Location: dashboard.php");
?>