<?php

// 1. Read data into variables
// $cid   = $_GET['cid'];
// $cname = $_GET['cname'];
// $email = $_GET['email'];
// $age   = $_GET['age'];
// $city  = $_GET['city'];
// $state = $_GET['state'];
$cid   = $_GET['cid'];
$cname = $_GET['cname'];
$email = $_GET['email'];
$age   = $_GET['age'];
$city  = $_GET['city'];
$state = $_GET['state'];

try {
    // 2. Connect to database
    $host = "localhost";
    $port = "5432";
    $dbname = "practice";
    $user = "postgres";
    $password = "@2333103080@";

    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $pdo = new PDO($dsn, $user, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 3. Frame insert query
    $sql = "INSERT INTO customer (cid, cname, email, age, city, state)
            VALUES (:cid, :cname, :email, :age, :city, :state)";

    $stmt = $pdo->prepare($sql);

    // 4. Perform insert
    $result = $stmt->execute([
        ':cid' => $cid,
        ':cname' => $cname,
        ':email' => $email,
        ':age' => $age,
        ':city' => $city,
        ':state' => $state
    ]);

    // 5. Display success / fail message
    if ($result) {
        echo "<h3 style='color:green;'>Customer Registered Successfully!</h3>";
    } else {
        echo "<h3 style='color:red;'>Failed to Register Customer!</h3>";
    }

} catch (PDOException $e) {
    echo "<h3 style='color:red;'>Error: " . $e->getMessage() . "</h3>";
}

?>


