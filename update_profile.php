<?php
session_start();

if (empty($_SESSION['login'])) {
    header("Location:index.php");
    exit;
}

include "koneksi.php"; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input from the form
    $nama = $_POST['nama'];
    $nowa = $_POST['nowa'];
    $email = $_POST['email'];

    // Assuming you have a 'users' table with columns 'nama', 'nowa', 'email'
    // Modify the SQL query according to your database structure
    $sql = "UPDATE login SET nama = '$nama', email = '$email' WHERE nowa = " . $_SESSION['nowa'];

    if ($koneksi->query($sql) === TRUE) {
        // Update the session variables with new data
        $_SESSION['nama'] = $nama;
        $_SESSION['nowa'] = $nowa;
        $_SESSION['email'] = $email;

        // Redirect back to the profile page
        header("Location: profil.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
