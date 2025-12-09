<?php
// Exposed Admin Panel - brak autoryzacji
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>
    <p>Default credentials: admin/admin</p>
    
    <form method="POST">
        <input name="username" placeholder="Username" value="admin">
        <input name="password" type="password" placeholder="Password" value="admin">
        <button>Login</button>
    </form>
    
    <?php
    if ($_POST["username"] === "admin" && $_POST["password"] === "admin") {
        echo "<h2>Welcome Admin!</h2>";
        echo "<p>Database Password: super_secret_db_pass_123</p>";
        echo "<p>API Key: sk_live_admin_key_123456</p>";
    }
    ?>
</body>
</html>

