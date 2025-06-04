<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'settings.php';


function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = clean_input($_POST['username']);
    $password = $_POST['password'];

    if (!preg_match('/^[a-zA-Z0-9_]{5,}$/', $username)) {
        die("Username must be at least 5 characters long and contain only letters, numbers, and underscores.");
    }

    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password)
        || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        die("Password must be at least 8 characters long and include upper/lowercase letters and numbers.");
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO managers (Username, PasswordHash) VALUES (?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $passwordHash);
    try{
        if ($stmt->execute()) {
            $registrationSuccess = "Manager registered successfully!";
        } else {
            $registrationError = "Username already exits!";
        }
    }catch(Exception $e) {
        $registrationError = "Username already exits!";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>  
<html lang="en">  
<?php
    include 'header.inc';
?>  


<body class="page-login bg-light ">
    <?php
 include 'nav.inc';
?>  
<div class="container">
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h2 class="card-title mb-4 text-center">Manager Registration</h2>
           <?php if (isset($registrationError)) echo "<div class='alert alert-danger'>$registrationError</div>"; ?>
           <?php if (isset($registrationSuccess)) echo "<div class='alert alert-success'>$registrationSuccess</div>"; ?>
            <form method="post" action="" class="form-control">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Register</button>

                <p class="mt-3 text-center">
                    Already registered? <a href="manage.php">Login here</a>
                </p>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php
        include 'footer.inc';
    ?>