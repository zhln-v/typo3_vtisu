<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(function () {
    $staffDoktype = 101;
    $newsDoktype = 102;

    ExtensionManagementUtility::addTCAcolumns('pages', [
        'is_paginated' => [
            'exclude' => true,
            'config' => [
                'type' => 'check',
                'items' => [
                    ['Пагинация', 1],
                ],
            ],
        ],
    ]);

    $GLOBALS['TCA']['pages']['palettes']['standard']['showitem'] =
        'is_paginated, ' . $GLOBALS['TCA']['pages']['palettes']['standard']['showitem'];


    $GLOBALS['TCA']['pages']['ctrl']['typeicon_classes'][$newsDoktype] = 'my-icon-news';
    $GLOBALS['TCA']['pages']['ctrl']['typeicon_classes'][$staffDoktype] = 'my-icon-staff';
});
