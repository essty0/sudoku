<?php
requare("tables.php");

$table0 = [
     'table2' => $table2,
     'table3' => $table3,
    'table4' => $table4,
];


/** Check if filled table is equal to stored table. If so, player wins */
function isWinner($values, $answer, $num)
{
    $newArr = [];
    $ans = [];
    // clear js array from html tags and conver to low 
    foreach ($values as $val) {
        $newArr[] = strtolower(strip_tags($val));
    }
    unset($val);

    // Convert stored array to the simple view
    for ($i = 0; $i < 16; $i++) {
        for ($j = 0; $j < 4; $j++) {
            for ($k = 0; $k < 4; $k++) {
                if (is_array($answer[$i][$j][$k])) {
                    $ans[] = $answer[$i][$j][$k][0];
                } else {
                    $ans[] = $answer[$i][$j][$k];
                }
            }
        }
    }
    // Compare two arrays
    for ($i = 0; $i < count($newArr); $i++) {
        if ($newArr[$i] != $ans[$i]) {
            if ($ans[$i] != $num) return 0; 
        }
    }
    return 1;
}

$data = $_POST;
$value = $data['value'];
$values = $data['values'];
$result = true;
$isWin = false;
$posElement = preg_split("/:/", $data['pos']); // coordinates of cell where user set a symbol
$tableId = $data['id']; // loading stored table from table.php file
$val = $table0[$tableId][$posElement[0]][$posElement[1]][$posElement[2]]; // get correct value from table
if ($val != strtolower($value)) { // compating values
    $result = false;
} else {
    $result = true;
}
if ($result && $values[0] !== 'false') {
    $isWin = isWinner($values, $table0[$tableId], $value);
}

 if ($isWin && $result) {
    echo json_encode('win');
 } elseif (!$result) {
     echo json_encode($result);
 }

?>