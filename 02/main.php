<?php

$input = "forward 5
down 5
forward 8
up 3
down 8
forward 2";

$horizontal_position = 0;
$depth = 0;
$aim = 0;

$inputs = explode("\n", $input);

array_map(function($value) use (&$horizontal_position, &$depth, &$aim) {
    $value = explode(' ', $value);
    $direction = $value[0];
    $distance = $value[1];

    switch($direction) {
        case 'forward':
            $horizontal_position += $distance;
            $depth += $aim * $distance;
            break;
        case 'down':
            $aim += $distance;
            break;
        case 'up':
            $aim -= $distance;
            break;
    }
}, $inputs);

echo "horizontal: $horizontal_position\n";
echo "depth: $depth\n";
echo "multiplied: ".($horizontal_position*$depth)."\n";