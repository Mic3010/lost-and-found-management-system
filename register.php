<?php include 'db.php'; ?>

<?php
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-body">

<div class="auth-box">
    <h2>Create Account</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="register">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>
</div>

</body>
</html>