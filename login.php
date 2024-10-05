<?php
$conn = new mysqli('localhost', 'root', '', 'user_auth');
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($query);
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        header('Location: dashboard.php');
    } else {
        $error = 'Invalid email or password!';
    }
}

if (isset($_POST['passcode_login'])) {
    $passcode = $_POST['passcode'];

 
    $query = "SELECT * FROM users WHERE passcode='$passcode'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        header('Location: dashboard.php');
    } else {
        $error = 'Invalid passcode!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function showPasscodePopup() {
            document.getElementById('passcode-popup').style.display = 'block';
        }
        function hidePasscodePopup() {
            document.getElementById('passcode-popup').style.display = 'none';
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <button onclick="showPasscodePopup()">Login with Passcode</button>

        <div id="passcode-popup" class="popup" style="display:none;">
            <div class="popup-content">
                <span class="close" onclick="hidePasscodePopup()">&times;</span>
                <h3>Enter Passcode</h3>
                <form method="POST">
                    <input type="text" name="passcode" placeholder="4-digit passcode" maxlength="4" required>
                    <button type="submit" name="passcode_login">Submit</button>
                </form>
            </div>
        </div>

        <p style="color:red;"><?php echo $error; ?></p>
    </div>
</body>
</html>
