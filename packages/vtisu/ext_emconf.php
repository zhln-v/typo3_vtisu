<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'vtisu',
    'description' => '',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-13.4.99',
            'fluid_styled_content' => '13.4.0-13.4.99',
            'rte_ckeditor' => '13.4.0-13.4.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Zhln\\Vtisu\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'zhln',
    'author_email' => 'zhln.v3+vtisu_typo3@gmail.com',
    'author_company' => 'zhln',
    'version' => '1.0.0',
];
