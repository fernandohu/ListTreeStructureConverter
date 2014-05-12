<?php

include('ListTreeStructureConverter.php');

$dataToArrange = [
    1 =>  [
        'name' => 'President',
    ],
    2 =>  [
        'name' => 'Director A',
    ],
    3 =>  [
        'name' => 'Director B',
    ],
    4 =>  [
        'name' => 'Director C',
    ],
    5 =>  [
        'name' => 'Manager A',
    ],
    6 =>  [
        'name' => 'Manager B',
    ],
    7 =>  [
        'name' => 'Team Leader A',
    ],
    8 =>  [
        'name' => 'Team Leader B',
    ],
    9 =>  [
        'name' => 'Employee A',
    ],
    10 =>  [
        'name' => 'Employee B',
    ],
    11 =>  [
        'name' => 'Employee C',
    ],
    12 =>  [
        'name' => 'Employee D',
    ]
];

$hierarchy = [
    1 => [2, 3, 4],
    2 => [6, 6],
    3 => [7],
    4 => [],
    5 => [7, 8],
    6 => [],
    7 => [9, 10],
    8 => [11, 12],
    9 => [],
    10 => [],
    11 => [],
    12 => [],
];

$ftc = new ListTreeStructureConverter();
$ftc->setData($dataToArrange);
$ftc->setHierarchy($hierarchy);
$result = $ftc->convert(1);

var_export($result);