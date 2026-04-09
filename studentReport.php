<?php
$sname=$_REQUEST["sname"];
$sno=$_REQUEST["sno"];
$m1=$_REQUEST["m1"];
$m2=$_REQUEST["m2"];
$m3=$_REQUEST["m3"];
$m4=$_REQUEST["m4"];


$total = $m1 + $m2 + $m3 + $m4;
$avg = $total / 4;

    if ($avg < 40) {
        $grade    = "Fail";
        $division = "Fail";
    } elseif ($avg < 50) {
        $grade    = "Pass";
        $division = "Pass Class";
    } elseif ($avg < 60) {
        $grade    = "Pass";
        $division = "Second Class";
    } elseif ($avg < 75) {
        $grade    = "Pass";
        $division = "First Class";
    } else {
        $grade    = "Good";
        $division = "First Class with Distinction";
    }

//  result
echo "Sno: $sno<br>";
echo "Name: $sname<br>";
echo "Marks: $m1, $m2, $m3, $m4<br>";
echo "Total Marks: $total<br>";
echo "Average: " . number_format($avg, 2) . "<br>";
echo "Grade: $grade<br>";
echo "division: $division";
?>