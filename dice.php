<?php

$dice = [];
$counters = [0, 0, 0, 0, 0, 0, 0]; 

for ($i = 0; $i < 5; $i++) {
    $dice[$i] = rand(1, 6);
}

foreach ($dice as $number) {
    $counters[$number] += 1;
}

echo implode($dice, ',') . ' - ';

if (in_array(5, $counters)) {
    echo "Покер" . PHP_EOL;
} else if (in_array(4, $counters)) {
    echo "Каре" . PHP_EOL;
} else if (in_array(3, $counters) && in_array(2, $counters)) {
    echo "Фул хаус" . PHP_EOL;
} else if (in_array(3, $counters)) {
    echo "Сет" . PHP_EOL;
} else if (strpos(implode($counters), '11111') !== FALSE) {
    echo "Большой стрит" . PHP_EOL;
} else if (is_small_straight($dice)) {
    echo "Малый стрит" . PHP_EOL;
} else if (count(array_keys($counters, 2)) === 2) {
    echo "Две пары" . PHP_EOL;
} else if (in_array(2, $counters)) {
    echo "Пара" . PHP_EOL;
} else {
    echo "Шанс" . PHP_EOL;
}

function is_small_straight($dice) {
    $counter = 0;

    for ($i = 0; $i < count($dice); $i++) {
        if ($dice[$i] + 1 === $dice[$i + 1]) {
            $counter++;
        }           
    }

    if ($counter === 3) {
        return true;
    }
    return false;
}
