<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'Custom dashboard widgets',
    'description' => 'Custom widgets for the TYPO3 10 dashboard',
    'category' => 'be',
    'author' => 'Philipp Kuhlmay',
    'author_company' => 'Treupo',
    'author_email' => 'philippkuhlmay@gmail.com',
    'state' => 'beta',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0 - 10.4.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'Treupo\CustomDashboardWidgets\\' => 'Classes'
        ]
    ],
];
