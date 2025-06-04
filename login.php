<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'settings.php';


// Handle login
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    // Settings
    $max_attempts = 3;
    $lockout_time = 5 * 60; // 5 minutes in seconds

    // Check for lockout
    if (isset($_SESSION['locked_time']) && time() < $_SESSION['locked_time']) {
        $remaining = $_SESSION['locked_time'] - time();
        $loginError =  "Too many failed attempts. Try again in " . ceil($remaining / 60) . " minutes.";
        exit;
    }


    $stmt = $conn->prepare("SELECT PasswordHash FROM managers WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hash);
    if ($stmt->fetch() && password_verify($password, $hash)) {
        $_SESSION['attempts'] = 0;
        unset($_SESSION['locked_time']);

        $_SESSION['manager'] = $username;
        header("Location: manage.php");
    } else {

        $_SESSION['attempts'] = isset($_SESSION['attempts']) ? ($_SESSION['attempts'] + 1) : 1;

        if ($_SESSION['attempts'] >= $max_attempts) {
            $_SESSION['locked_time'] = time() + $lockout_time;
            $loginError = "Too many failed attempts. You are locked out for 5 minutes.";
        } else {
            $remaining_attempts = $max_attempts - $_SESSION['attempts'];
            $loginError = "Invalid username or password.";
        }
    }
    $stmt->close();
}

// Show login form if not logged in
if (!isset($_SESSION['manager'])) {
?>


<!DOCTYPE html>  
<html lang="en">  
<?php
    include 'header.inc';
?>  
<header>  
            <?php
                include 'nav.inc';
             ?>   
    </header>  
<body class="page-login bg-light">
<div class="container .page-login">
    <div class="card mx-auto shadow" style="max-width: 500px;">
        <div class="card-body">
            <h2 class="text-center mb-4">Manager Login</h2>
            <?php if (isset($loginError)) echo "<div class='alert alert-danger'>$loginError</div>"; ?>
            <form method="post" class="form-control">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            </form>
            <p class="mt-3 text-center">
                Don't have an account? <a href="register.php" class="btn btn-link">Register</a>
            </p>
        </div>
    </div>
</div>
<p></p>
</body>
</html>
<?php
        include 'footer.inc';
    ?>
<?php
    exit();
}else{
     header("Location: manage.php");
}
?>

