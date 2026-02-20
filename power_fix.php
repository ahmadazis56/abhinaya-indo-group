<?php
session_start();

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'abhinaya_admin';

function tableExists(mysqli $conn, string $dbName, string $tableName): bool {
    $sql = "SELECT 1 FROM information_schema.TABLES WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $dbName, $tableName);
    $stmt->execute();
    $res = $stmt->get_result();
    $exists = $res && $res->num_rows > 0;
    $stmt->close();
    return $exists;
}

function columnExists(mysqli $conn, string $dbName, string $tableName, string $columnName): bool {
    $sql = "SELECT 1 FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND COLUMN_NAME = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $dbName, $tableName, $columnName);
    $stmt->execute();
    $res = $stmt->get_result();
    $exists = $res && $res->num_rows > 0;
    $stmt->close();
    return $exists;
}

function runAlterIfMissing(mysqli $conn, string $dbName, string $tableName, string $columnName, string $alterSql, array &$logs): void {
    if (!tableExists($conn, $dbName, $tableName)) {
        $logs[] = "Table not found: {$tableName}";
        return;
    }

    if (columnExists($conn, $dbName, $tableName, $columnName)) {
        $logs[] = "OK: {$tableName}.{$columnName} already exists";
        return;
    }

    if ($conn->query($alterSql)) {
        $logs[] = "ADDED: {$tableName}.{$columnName}";
    } else {
        $logs[] = "FAILED: {$tableName}.{$columnName} => {$conn->error}";
    }
}

$logs = [];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['do_fix']) && $_POST['do_fix'] === '1') {
    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error) {
        $error = "Connection failed: " . $conn->connect_error;
    } else {
        $conn->set_charset('utf8mb4');

        runAlterIfMissing(
            $conn,
            $database,
            'team',
            'division',
            "ALTER TABLE team ADD COLUMN division VARCHAR(50) DEFAULT 'general' AFTER role",
            $logs
        );

        runAlterIfMissing(
            $conn,
            $database,
            'events',
            'event_date',
            "ALTER TABLE events ADD COLUMN event_date DATE AFTER title",
            $logs
        );

        runAlterIfMissing(
            $conn,
            $database,
            'events',
            'location',
            "ALTER TABLE events ADD COLUMN location VARCHAR(255) AFTER event_date",
            $logs
        );

        runAlterIfMissing(
            $conn,
            $database,
            'gallery',
            'sort_order',
            "ALTER TABLE gallery ADD COLUMN sort_order INT DEFAULT 0 AFTER description",
            $logs
        );

        $conn->close();

        $hasFailure = false;
        foreach ($logs as $line) {
            if (strpos($line, 'FAILED:') === 0 || strpos($line, 'Table not found:') === 0) {
                $hasFailure = true;
                break;
            }
        }

        if (!$hasFailure) {
            $_SESSION['success_message'] = 'Database fixed successfully.';
            @unlink(__FILE__);
            header('Location: index.php');
            exit;
        }

        $error = 'Some fixes failed. Please review the log below.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power Fix</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f6f7fb; margin:0; padding:40px; }
        .container { max-width: 860px; margin: 0 auto; }
        .card { background:#fff; border-radius:12px; padding:24px; box-shadow:0 6px 18px rgba(0,0,0,0.08); }
        .btn { display:inline-block; padding:14px 18px; border-radius:10px; border:none; cursor:pointer; font-weight:700; }
        .btn-primary { background:#14aecf; color:#fff; }
        .btn-primary:hover { background:#0f8c9f; }
        .log { margin-top:18px; background:#0f172a; color:#e2e8f0; padding:16px; border-radius:10px; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; font-size: 13px; white-space: pre-wrap; }
        .error { margin-top: 16px; padding:12px 14px; background:#fee2e2; color:#991b1b; border-radius:10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <form method="POST" style="margin:0;">
                <input type="hidden" name="do_fix" value="1">
                <button type="submit" class="btn btn-primary">FIX DATABASE &amp; CLEANUP</button>
            </form>

            <?php if (!empty($error)): ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <?php if (!empty($logs)): ?>
                <div style="margin-top:16px;">
                    <div class="log"><?php echo htmlspecialchars(implode("\n", $logs)); ?></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
