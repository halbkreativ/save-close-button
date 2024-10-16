<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Save+Close Button',
    'description' => 'Adds a Save+Close Button to the TYPO3 Backend.',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-13.4.99',
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'halbkreativ\\SaveCloseButton\\' => 'Classes/',
        ],
    ],
];
