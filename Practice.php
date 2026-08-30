Hello World
<?php

echo "Hello World!";

?>

Declaring Variables

<?php

$name = "SpeX";
$age = 24;
$cgpa = 3.60;

echo $name;
echo "<br>";
echo $age;
echo "<br>";
echo $cgpa;

?>

Printing

<?php

$name = "Tasnu";
$age = 25;

echo "My name is $name";
echo "<br>";
echo "I am $age years old.";

?>

Basic Operators

<?php

$a = 10;
$b = 5;

echo $a + $b;
echo "<br>";

echo $a - $b;
echo "<br>";

echo $a * $b;
echo "<br>";

echo $a / $b;
echo "<br>";

echo $a % $b;

?>

If

<?php

$age = 20;

if ($age >= 18) {
    echo "Adult";
}

?>

If else

<?php

$age = 16;

if ($age >= 18) {
    echo "Adult";
} else {
    echo "Child";
}

?>

If else if else

<?php

$marks = 75;

if ($marks >= 80) {
    echo "A+";
} elseif ($marks >= 70) {
    echo "A";
} elseif ($marks >= 60) {
    echo "B";
} else {
    echo "Fail";
}

?>

Switch

<?php

$day = 3;

switch ($day) {

    case 1:
        echo "Sunday";
        break;

    case 2:
        echo "Monday";
        break;

    case 3:
        echo "Tuesday";
        break;

    case 4:
        echo "Wednesday";
        break;

    default:
        echo "Invalid day";
}

?>

Loop

<?php

for ($i = 1; $i <= 5; $i++) {
    echo $i;
    echo "<br>";
}

?>

While Loop

<?php

$i = 1;

while ($i <= 5) {

    echo $i;
    echo "<br>";

    $i++;
}

?>
