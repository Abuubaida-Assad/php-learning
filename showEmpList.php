<!-- <?php
// $host = "localhost";
// $port = "5432";
// $dbname = "practice";
// $user = "postgres";
// $password = "@2333103080@";

// try {
//     $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    
//     $pdo = new PDO($dsn, $user, $password);

//     // set error mode
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     echo "Connected successfully!";
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }
?> -->


<?php
$host = "localhost";
$port = "5432";
$dbname = "practice";
$user = "postgres";
$password = "@2333103080@";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h2>Employee Data</h2>";

    $sql = "SELECT * FROM emp";
    $stmt = $pdo->query($sql);

    $x= "<table border='1' cellpadding='10'>";
    // $x=$x. "<tr><th>ID</th><th>Name</th></th></th></tr>"; 
    $x = $x."<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Job</th>
    <th>Salary</th>
    <th>Join Date</th>
    <th>Dept No</th>
    <th>Common</th>
    <th>Manager</th>
    <th>Email</th>
    </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $x=$x. "<tr>";
        $x=$x. "<td>" . $row['id'] . "</td>";
        $x=$x. "<td>" . $row['ename'] . "</td>";
        $x=$x."<td>" . $row['job'] . "</td>";
        $x=$x. "<td>" . $row['salary'] . "</td>";
        $x=$x. "<td>" . $row['joindate'] . "</td>";
        $x=$x. "<td>" . $row['deptno'] . "</td>";
        $x=$x. "<td>" . $row['common'] . "</td>";
        $x=$x. "<td>" . $row['mgr'] . "</td>";
        $x=$x."<td>" . $row['email'] . "</td>";
        $x=$x. "</tr>";
    }

    $x=$x. "</table>";
    echo $x;

}
 catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>