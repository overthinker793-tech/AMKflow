<?php
require 'db.php';
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['customer_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $details = trim($_POST['details'] ?? '');

    if (!empty($name) && !empty($email) && !empty($phone) && !empty($service)) {
        $stmt = $pdo->prepare("INSERT INTO orders (customer_name, email, phone, service, details) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $email, $phone, $service, $details])) {
            $message = "Тапсырыс сәтті жіберілді!";
        } else {
            $message = "Қате орын aldı.";
        }
    } else {
        $message = "Барлық міндетті өрістерді толтырыңыз!";
    }
}
?>
<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <title>AMK flow - Білім беру платформасы</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f4f4f9; color: #333; }
        header { background: #007bff; color: white; padding: 15px; text-align: center; border-radius: 5px; }
        .container { max-width: 800px; margin: 20px auto; background: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        form input, form select, form textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        form button { background: #28a745; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 4px; }
        form button:hover { background: #218838; }
        .msg { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <header>
        <h1>AMK flow жүйесіне қош келдіңіз!</h1>
        <p>Білім беру платформасы және тапсырыстарды басқару</p>
    </header>
    <div class="container">
        <h2>Тапсырыс беру формасы</h2>
        <?php if($message): ?>
            <p class="msg"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <form method="POST">
            <label>Аты-жөніңіз:</label>
            <input type="text" name="customer_name" required>
            
            <label>Электрондық пошта (Email):</label>
            <input type="email" name="email" required>
            
            <label>Телефон нөмірі:</label>
            <input type="text" name="phone" required>
            
            <label>Қызмет түрі:</label>
            <select name="service" required>
                <option value="Веб-разработка курсы">Веб-разработка курсы</option>
                <option value="Цифрлық кітапханаға қолжетімділік">Цифрлық кітапханаға қолжетімділік</option>
                <option value="Жеке менторлық сабақ">Жеке менторлық сабақ</option>
            </select>
            
            <label>Толық сипаттамасы:</label>
            <textarea name="details" rows="4"></textarea>
            
            <button type="submit">Тапсырысты жіберу</button>
        </form>
        <p><a href="admin.php">Әкімші панеліне өту</a></p>
    </div>
</body>
</html>