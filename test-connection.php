<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Test Koneksi Database Inventaris Barang Laboratorium</h2>";

echo "<h3>1. Cek File Exists</h3>";
$files = [
    'app/config/Config.php',
    'app/config/Database.php',
    'app/core/Model.php',
    'app/models/Inventaris.php',
];

foreach ($files as $file) {
    if (file_exists($file)) {
        echo "✅ {$file} - EXISTS<br>";
    } else {
        echo "❌ {$file} - NOT FOUND<br>";
    }
}

echo "<h3>2. Load Files</h3>";
try {
    require_once 'app/config/Config.php';
    echo "✅ Config.php loaded<br>";

    require_once 'app/config/Database.php';
    echo "✅ Database.php loaded<br>";

    require_once 'app/core/Model.php';
    echo "✅ Model.php loaded<br>";

    require_once 'app/models/Inventaris.php';
    echo "✅ Inventaris.php loaded<br>";
} catch (Throwable $e) {
    echo "❌ Error loading file: " . $e->getMessage() . "<br>";
    die();
}

echo "<h3>3. Test Database Connection</h3>";
try {
    $db = new Database();
    $conn = $db->getConnection();

    if ($conn) {
        echo "✅ Database connected successfully!<br>";
        echo "Database: <b>" . Config::$DB_NAME . "</b><br>";

        // Test query inventaris
        $stmt = $conn->query("SELECT COUNT(*) AS total FROM inventaris");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "✅ Total data inventaris: <b>" . $result['total'] . "</b><br>";
    } else {
        echo "❌ Database connection failed<br>";
    }
} catch (Throwable $e) {
    echo "❌ Database Error: " . $e->getMessage() . "<br>";
}

echo "<h3>4. Test Model Inventaris</h3>";
try {
    $inventaris = new Inventaris($conn);
    $stmt = $inventaris->getAll();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "✅ Model Inventaris BERHASIL dijalankan<br>";
    echo "<pre>";
    print_r($data);
    echo "</pre>";

} catch (Throwable $e) {
    echo "❌ Model Error: " . $e->getMessage() . "<br>";
}