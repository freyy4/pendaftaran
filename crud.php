<?php
// CREATE - Tambahkan pesan baru
function addMessage($role, $message) {
    global $conn;
    $role = mysqli_real_escape_string($conn, $role);
    $message = mysqli_real_escape_string($conn, $message);
    $sql = "INSERT INTO messages (role, message) VALUES ('$role', '$message')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// READ - Ambil semua pesan
function getAllMessages() {
    global $conn;
    $sql = "SELECT * FROM messages ORDER BY created_at ASC";
    $result = $conn->query($sql);
    $messages = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    }
    return $messages;
}

// UPDATE - Edit pesan
function editMessage($id, $message) {
    global $conn;
    $message = mysqli_real_escape_string($conn, $message);
    $sql = "UPDATE messages SET message='$message' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// DELETE - Hapus pesan
function deleteMessage($id) {
    global $conn;
    $sql = "DELETE FROM messages WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
?>
