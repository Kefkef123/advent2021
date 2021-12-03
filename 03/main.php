<?php

$input = "00100
11110
10110
10111
10101
01111
00111
11100
10000
11001
00010
01010";

$inputs = explode("\n", $input);
$strlen = strlen($inputs[0]);

$gamma = '';

for($i = 0; $i < $strlen; $i++) {
    $gamma .= getMostCommonCharAtPos($inputs, $i);
}

$epsilon = '';

for($i = 0; $i < $strlen; $i++) {
    $epsilon .= getMostCommonCharAtPos($inputs, $i, true);
}

echo "gamma: $gamma " . bindec($gamma) . "\n";
echo "epsilon: $epsilon " . bindec($epsilon) . "\n";
echo "multiplied: ". (bindec($gamma) * bindec($epsilon)) . "\n";

for($i = 0; $i < $strlen; $i++) {
    $character = getMostCommonCharAtPos($inputs, $i);

    $inputs = array_filter($inputs, function($var) use ($i, $character){
        return $var[$i] == $character;
    });
}

$oxygen_rating = array_values($inputs)[0];

echo "oxygen: $oxygen_rating " . bindec($oxygen_rating) . "\n";

$inputs = explode("\n", $input);

for($i = 0; $i < $strlen; $i++) {
    $character = getMostCommonCharAtPos($inputs, $i, true);

    $inputs = array_filter($inputs, function($var) use ($i, $character){
        return $var[$i] == $character;
    });
}

$co2_rating = array_values($inputs)[0];

echo "co2: $co2_rating " . bindec($co2_rating) . "\n";
echo "multiplied: ". (bindec($oxygen_rating) * bindec($co2_rating)) . "\n";


function getMostCommonCharAtPos(array $array, int $pos, bool $least = false) : string {
    array_walk($array, function(&$item) use ($pos) {
        $item = $item[$pos];
    });

    $character_counts = array_count_values($array);

    asort($character_counts);

    if(count($character_counts) > 1 && $character_counts[0] == $character_counts[1]) {
        return $least ? '0' : '1';
    }

    if($least) {
        return array_key_first($character_counts);
    }

    return array_key_last($character_counts);
}