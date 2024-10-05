<?php
$conn = new mysqli('localhost', 'root', '', 'user_auth');

$emailExistsError = '';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

  
    $emailCheckQuery = "SELECT * FROM users WHERE email='$email'";
    $emailCheckResult = $conn->query($emailCheckQuery);

    if ($emailCheckResult->num_rows > 0) {
        $emailExistsError = 'Email already used. Please try a different email.';
    } else {
        $passcode = rand(1000, 9999); 

        $query = "INSERT INTO users (username, email, password, passcode) VALUES ('$username', '$email', '$password', '$passcode')";

        if ($conn->query($query)) {
            echo "<script>
                window.onload = function() {
                    showPasscodePopup('$passcode');
                };
            </script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure User Authentiation</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function showPasscodePopup(passcode) {
            document.getElementById('passcode-value').innerText = passcode;
            document.getElementById('passcode-popup').style.display = 'block';
        }

        function copyPasscode() {
            const passcode = document.getElementById('passcode-value').innerText;
            navigator.clipboard.writeText(passcode).then(() => {
                alert('Passcode copied to clipboard!');
            });
        }

        function closePopup() {
            document.getElementById('passcode-popup').style.display = 'none';
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Create an Account</h2>
            <form method="POST">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit">Register</button>
            </form>

            <p class="error-message"><?php echo $emailExistsError; ?></p>

            <p class="login-link">Already have an account? <a href="login.php">Login Here</a></p>
        </div>
    </div>

    <div id="passcode-popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <h3>Your Unique Passcode</h3>
            <p id="passcode-value"></p>
            <button onclick="copyPasscode()">Copy Passcode</button>
        </div>
    </div>
</body>
</html>
