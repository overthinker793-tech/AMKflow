<?php
require 'db.php';

// Күйді өзгерту логикасы
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];
    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$new_status, $order_id]);
}

$stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <title>EduFlow - Әкімші панелі</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f4f4f9; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #343a40; color: white; }
        select { padding: 5px; }
        button { padding: 5px 10px; background: #007bff; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Әкімші панелі: Тапсырыстар тізімі</h1>
    <p><a href="index.php">← Басты бетке қайту</a></p>
    <table>
        <tr>
            <th>ID</th>
            <th>Клиент</th>
            <th>Email</th>
            <th>Телефон</th>
            <th>Қызмет</th>
            <th>Сипаттама</th>
            <th>Күйі</th>
            <th>Уақыты</th>
            <th>Әрекет</th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><?= htmlspecialchars($order['customer_name']) ?></td>
            <td><?= htmlspecialchars($order['email']) ?></td>
            <td><?= htmlspecialchars($order['phone']) ?></td>
            <td><?= htmlspecialchars($order['service']) ?></td>
            <td><?= htmlspecialchars($order['details']) ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                    <select name="status">
                        <option value="Жаңа" <?= $order['status'] == 'Жаңа' ? 'selected' : '' ?>>Жаңа</option>
                        <option value="Қаралуда" <?= $order['status'] == 'Қаралуда' ? 'selected' : '' ?>>Қаралуда</option>
                        <option value="Орындалуда" <?= $order['status'] == 'Орындалуда' ? 'selected' : '' ?>>Орындалуда</option>
                        <option value="Аяқталды" <?= $order['status'] == 'Аяқталды' ? 'selected' : '' ?>>Аяқталды</option>
                        <option value="Бас тартылды" <?= $order['status'] == 'Бас тартылды' ? 'selected' : '' ?>>Бас тартылды</option>
                    </select>
            </td>
            <td><?= $order['created_at'] ?></td>
            <td>
                    <button type="submit" name="update_status">Сақтау</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>