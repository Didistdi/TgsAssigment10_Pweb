<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM cart WHERE id = $id");
    $item = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE cart SET product_name = ?, quantity = ?, price = ? WHERE id = ?");
    $stmt->bind_param("sidi", $product_name, $quantity, $price, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
</head>
<body>
    <h1>Edit Produk</h1>
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?= $item['id']; ?>">
        <input type="text" name="product_name" value="<?= $item['product_name']; ?>" required>
        <input type="number" name="quantity" value="<?= $item['quantity']; ?>" required>
        <input type="number" step="0.01" name="price" value="<?= $item['price']; ?>" required>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
