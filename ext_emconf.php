<?php

/**
 * Extension Manager/Repository config file for ext "demo_package".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Custom dashboard widgets',
    'description' => 'Custom widgets for the TYPO3 10 dashboard',
    'category' => 'be',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-10.4.99',
            'dashboard' => '10.4.0-10.4.99'
        ]
    ],
    'autoload' => [
        'psr-4' => [
            'Treupo\\CustomDashboardWidgets\\' => 'Classes',
        ],
    ],
    'state' => 'beta',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Philipp Kuhlmay',
    'author_email' => 'philippkuhlmay@gmail.com',
    'author_company' => 'Treupo',
    'version' => '1.0.0',
];
