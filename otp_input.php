<?php
session_start();

if (empty($_SESSION['otp'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_input_otp = isset($_POST['otp']) ? $_POST['otp'] : '';

    // Check if the entered OTP is correct
    if ($user_input_otp == $_SESSION['otp']) {
        // Mark email as verified
        $_SESSION['email_verified'] = true;
        header("Location: profile.php"); // Redirect to the user's profile page
        exit;
    } else {
        $error_message = "OTP salah. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input OTP</title>
    <!-- Add your styles or use Bootstrap styles -->
</head>

<body>

    <h2>Input OTP</h2>

    <?php
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

    <form method="post">
        <label for="otp">Masukkan OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

</body>

</html>
