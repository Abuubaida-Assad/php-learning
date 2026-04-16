<?php
header("Content-Type: application/json");

$host = "localhost";
$port = "5432";
$dbname = "Leapstart";
$user = "postgres";
$password = "@2333103080@";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get POST data
    $idno = $_POST['idno'];
    $password_input = $_POST['password'];

    // Check user
    $sql = "SELECT * FROM candidates WHERE idno = :idno AND isActive = TRUE";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':idno' => $idno]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password_input, $user['password'])) {

        // Generate secure token (50 chars)
        $token = bin2hex(random_bytes(25)); // 25 bytes = 50 hex chars

        // Insert token
        $insertToken = "INSERT INTO userTokens (idno, token)
                        VALUES (:idno, :token)";
        $stmt2 = $pdo->prepare($insertToken);
        $stmt2->execute([
            ':idno' => $idno,
            ':token' => $token
        ]);

        echo json_encode([
            "status" => "success",
            "message" => "Login successful",
            "token" => $token
        ]);

    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid ID or Password"
        ]);
    }

} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>