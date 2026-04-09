<?php

include("searchcustomer.html");

$host = "localhost";
$port = "5432";
$dbname = "practice";
$user = "postgres";
$password = "@2333103080@";

// Check input
if (!isset($_GET['cid']) || empty($_GET['cid'])) {
    echo "<h3 style='color:red;text-align:center;'>Please enter Customer ID</h3>";
    exit();
}

$cid = $_GET['cid'];

try {
    // Connect DB 
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query
    $sql = "SELECT * FROM customer WHERE cid = :cid";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':cid' => $cid]);

    echo "<h2 style='text-align:center;'>Search Result</h2>";

    if ($stmt->rowCount() > 0) {

    $x= "<table border='1' cellpadding='10' align='center'>";
    // $x=$x. "<tr><th>ID</th><th>Name</th></th></th></tr>"; 
    $x = $x."<tr>
    <th>ID</th>
    <th>Name</th>
    <th>email</th>
    <th>age</th>
    <th>city</th>
    <th>state</th>
  
    </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $x=$x. "<tr>";
        $x=$x. "<td>" . $row['cid'] . "</td>";
        $x=$x. "<td>" . $row['cname'] . "</td>";
        $x=$x."<td>" . $row['email'] . "</td>";
        $x=$x. "<td>" . $row['age'] . "</td>";
        $x=$x. "<td>" . $row['city'] . "</td>";
        $x=$x. "<td>" . $row['state'] . "</td>";
        $x=$x. "</tr>";
    }

    $x=$x. "</table>";
    echo $x;

    } else {
        echo "<h3 style='color:red;text-align:center;'>Record Not Found</h3>";
    }

} catch (PDOException $e) {
    echo "<h3 style='color:red;text-align:center;'>Database Error: " . $e->getMessage() . "</h3>";
}

?>




