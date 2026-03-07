<?php
session_start();
require_once "config/database.php";

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$db = new Database();
$conn = $db->connect();

if(isset($_POST['add_note'])) {

    $title = $_POST['title'];
    $desc = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO notes (user_id, title, description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$user_id, $title, $desc]);
}
?>

<form method="POST">
    <input type="text" name="title" placeholder="Title" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <button name="add_note">Add Note</button>
</form>

<?php
$query = "SELECT * FROM notes WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$_SESSION['user_id']]);

$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($notes as $note) {
    echo "<h3>".$note['title']."</h3>";
    echo "<p>".$note['description']."</p>";
    echo "<a href='delete.php?id=".$note['id']."'>Delete</a>";
}
?>
