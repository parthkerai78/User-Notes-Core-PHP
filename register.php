<?php
    require_once "config/database.php";

    $db = new Database();
    $conn = $db->connect();

    if(isset($_POST['register'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $query = ("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt = $conn->prepare($query);
        $stmt->execute([$name, $email, $password]);

        echo "Registeration Successfull";
        header("Location: login.php");
    }
?>

<form method="POST">
    <input type="text" name="name" placeholder="Enter your name" required><br>
    <input type="email" name="email" placeholder="Enter your Email" required><br>
    <input type="password" name="password" placeholder="Enter your password" required><br>
    <button name="register">Register</button>
</form>
