<?php

require_once "config/database.php";

$db = new Database();
$conn = $db->connect();

$id = $_GET['id'];

$query = "SELECT * FROM notes WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$id]);

$note = $stmt->fetch(PDO::FETCH_ASSOC);

?>


<h2>Edit Note</h2>

<form method="POST">
<input type="text" name="title" value="<?php echo $note['title']; ?>"><br>
<textarea name="description"><?php echo $note['description']; ?></textarea><br>
<button name="update_note">Update</button>
</form>



<?php
if(isset($_POST['update_note'])){

    $title = $_POST['title'];
    $description = $_POST['description'];

    $query = "UPDATE notes SET title = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$title, $description, $id]);

    header("Location: dashboard.php");
}
?>




