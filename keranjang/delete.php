<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($conn->query("DELETE FROM cart WHERE id = $id")) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
