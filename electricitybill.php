

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cno = $_POST["cno"];
    $cname = $_POST["cname"];
    $cread = floatval($_POST["cread"]);
    $pread = floatval($_POST["pread"]);

    if ($cread < $pread) {
        echo "Error: Current reading cannot be less than previous reading!";
    } else {
        $units = $cread - $pread;

        if ($units <= 200) {
            $amount = $units * 1;
        } elseif ($units <= 300) {
            $amount = 200*1 + ($units-200)*1.25;
        } elseif ($units <= 400) {
            $amount = 200*1 + 100*1.25 + ($units-300)*1.5;
        } elseif ($units <= 500) {
            $amount = 200*1 + 100*1.25 + 100*1.5 + ($units-400)*1.75;
        } else {
            $amount = 200*1 + 100*1.25 + 100*1.5 + 100*1.75 + ($units-500)*2;
        }

        $surcharge = $amount * 0.10;
        $total = $amount + $surcharge;

        echo "CNO: $cno<br>";
        echo "Name: $cname<br>";
        echo "Previous Reading: $pread<br>";
        echo "Current Reading: $cread<br>";
        echo "Units: $units<br>";
        echo "Amount: ₹".number_format($amount,2)."<br>";
        echo "Surcharge: ₹".number_format($surcharge,2)."<br>";
        echo "Total: ₹".number_format($total,2)."<br>";
    }

} else {
    echo "Invalid use of POST method";
}
?>