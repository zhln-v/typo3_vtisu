<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(function () {
    $newsDoktype = 102;

    // Зарегистрировать тип "Новость"
    $GLOBALS['TCA']['pages']['columns']['doktype']['config']['items'][] = [
        'Новость',
        $newsDoktype,
        'my-icon-news'
    ];

    $GLOBALS['PAGES_TYPES'][$newsDoktype] = [
        'type' => 'web',
        'allowedTables' => '*',
    ];

    // Настроить отображение полей для новости
    $GLOBALS['TCA']['pages']['types'][$newsDoktype] = [
        'showitem' => '
            --palette--;;standard,
            title;Заголовок новости,
            news_date;Дата публикации,
            news_image;Превью новости,
            news_intro;Краткое описание,
            bodytext;Текст новости,
            slug,
            --palette--;;visibility
        ',
    ];

    // Зарегистрировать поля
    ExtensionManagementUtility::addTCAcolumns('pages', [
        'news_date' => [
            'exclude' => true,
            'label' => 'Дата публикации',
            'config' => [
                'type' => 'input',
                'eval' => 'date',
                'renderType' => 'inputDateTime',
                'size' => 10,
            ],
        ],
        'news_image' => [
            'exclude' => true,
            'label' => 'Превью новости',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'sys_file_reference',
                'foreign_field' => 'uid_foreign',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablenames',
                'foreign_match_fields' => [
                    'fieldname' => 'news_image',
                ],
                'appearance' => [
                    'createNewRelationLinkTitle' => 'Добавить изображение',
                    'showPossibleLocalizationRecords' => true,
                    'showRemovedLocalizationRecords' => true,
                    'showSynchronizationLink' => true,
                    'useSortable' => true,
                ],
                'filter' => [
                    'userFunc' => \TYPO3\CMS\Core\Resource\Filter\FileExtensionFilter::class . '->imageFilter'
                ]
            ]
        ],
        'news_intro' => [
            'exclude' => true,
            'label' => 'Краткое описание',
            'config' => [
                'type' => 'text',
                'rows' => 4,
                'cols' => 60,
            ]
        ],
    ]);
});
