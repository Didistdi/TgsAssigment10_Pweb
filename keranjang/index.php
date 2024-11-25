<?php
include 'db.php';

// Fetch items from the cart
$result = $conn->query("SELECT * FROM cart");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
</head>
<body>
    <h1>List produk</h1>

    <form action="add.php" method="POST">
        <input type="text" name="product_name" placeholder="Nama Produk" required>
        <input type="number" name="quantity" placeholder="Jumlah" required>
        <input type="number" step="1000" name="price" placeholder="Harga" required>
        <button type="submit">Tambah ke Keranjang</button>
    </form>

    <h2>Daftar Produk</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['product_name']); ?></td>
                    <td><?= $row['quantity']; ?></td>
                    <td><?= number_format($row['price'], 2); ?></td>
                    <td><?= number_format($row['quantity'] * $row['price'], 2); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Hapus item ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
