<?php
require __DIR__ . '/config.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['customer_name'] ?? '');
    $email = trim($_POST['customer_email'] ?? '');
    $date = trim($_POST['appointment_date'] ?? '');
    $purpose = trim($_POST['purpose'] ?? '');
    if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $date === '' || $purpose === '') {
        $message = 'Please complete all fields with a valid email.';
    } else {
        $stmt = $pdo->prepare('INSERT INTO appointments (customer_name, customer_email, appointment_date, purpose) VALUES (?, ?, ?, ?)');
        $stmt->execute([$name, $email, $date, $purpose]);
        $message = 'Appointment saved in the local demo database.';
    }
}
$appointments = $pdo->query('SELECT id, customer_name, appointment_date, purpose FROM appointments ORDER BY appointment_date DESC LIMIT 100')->fetchAll();
function e(string $value): string { return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Bank Appointment Demo</title><link rel="stylesheet" href="style.css"></head><body><main><header><small>ACADEMIC DEMO · SYNTHETIC DATA ONLY</small><h1>Appointment Management</h1><p>PHP · MySQL · PDO prepared statements</p></header>
<section class="card"><h2>New appointment</h2><?php if ($message): ?><p class="message"><?= e($message) ?></p><?php endif; ?><form method="post"><label>Name<input name="customer_name" required maxlength="120"></label><label>Email<input type="email" name="customer_email" required maxlength="190"></label><label>Date and time<input type="datetime-local" name="appointment_date" required></label><label>Purpose<input name="purpose" required maxlength="255"></label><button>Save appointment</button></form></section>
<section class="card"><h2>Appointments</h2><?php foreach ($appointments as $a): ?><article><strong><?= e($a['customer_name']) ?></strong><span><?= e($a['appointment_date']) ?> — <?= e($a['purpose']) ?></span></article><?php endforeach; ?><?php if (!$appointments): ?><p>No appointments yet.</p><?php endif; ?></section><footer>Local learning project. Not production banking software.</footer></main></body></html>
