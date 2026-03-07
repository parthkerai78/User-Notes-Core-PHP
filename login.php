<?php
    require_once "config/database.php";

    $db = new Database();
    $conn = $db->connect();

    if(isset($_POST['login'])){
        
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = ("SELECT * FROM users WHERE email = ?");
        $stmt = $conn->prepare($query);
        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            header ("Location: dashboard.php");
        }
        else{
            echo "Invalid Credentials";
        }
    }
?>

<form method="POST">
    <input type="email" name="email" placeholder="Enter your Email" required><br>
    <input type="password" name="password" placeholder="Enter your Password" required><br>
    <button name="login">Login</button>
</form>