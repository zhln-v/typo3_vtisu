<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(function () {
    $customDoktype = 101;

    // Зарегистрировать как тип страницы
    $GLOBALS['TCA']['pages']['columns']['doktype']['config']['items'][] = [
        'Сотрудник',
        $customDoktype,
        'my-icon-staff'
    ];

    $GLOBALS['PAGES_TYPES'][$customDoktype] = [
        'type' => 'web',
        'allowedTables' => '*',
    ];

    // Настроить отображение вкладок
    $GLOBALS['TCA']['pages']['types'][$customDoktype] = [
        'showitem' => '
            --palette--;;standard,
            title;ФИО,
            image;Фото,
            position;Должность,
            degree;Учёная степень,
            experience_total;Общий опыт работы,
            experience_spec;Опыт по специальности,
            courses;Преподаваемые дисциплины,
            email;Email,
            phone;Телефон,
            room;Кабинет,
            bodytext;Биография,
            publications;Публикации,
            slug,
            --palette--;;visibility
        ',
    ];

    // Зарегистрировать кастомные поля
    ExtensionManagementUtility::addTCAcolumns('pages', [
        'image' => [
            'exclude' => true,
            'label' => 'Фото',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'sys_file_reference',
                'foreign_field' => 'uid_foreign',
                'foreign_sortby' => 'sorting',
                'foreign_table_field' => 'tablenames',
                'foreign_match_fields' => [
                    'fieldname' => 'image',
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
        'position' => [
            'exclude' => true,
            'label' => 'Должность',
            'config' => [
                'type' => 'input',
                'size' => 50
            ]
        ],
        'degree' => [
            'exclude' => true,
            'label' => 'Учёная степень',
            'config' => [
                'type' => 'input',
                'size' => 50
            ]
        ],
        'experience_total' => [
            'exclude' => true,
            'label' => 'Общий опыт работы',
            'config' => [
                'type' => 'input',
                'size' => 30
            ]
        ],
        'experience_spec' => [
            'exclude' => true,
            'label' => 'Опыт по специальности',
            'config' => [
                'type' => 'input',
                'size' => 30
            ]
        ],
        'courses' => [
            'exclude' => true,
            'label' => 'Преподаваемые дисциплины (по строкам)',
            'config' => [
                'type' => 'text',
                'rows' => 5,
                'cols' => 50,
            ]
        ],
        'email' => [
            'exclude' => true,
            'label' => 'Email',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,email',
                'size' => 50,
            ]
        ],
        'phone' => [
            'exclude' => true,
            'label' => 'Телефон',
            'config' => [
                'type' => 'input',
                'size' => 30
            ]
        ],
        'room' => [
            'exclude' => true,
            'label' => 'Кабинет',
            'config' => [
                'type' => 'input',
                'size' => 30
            ]
        ],
        'bodytext' => [
            'exclude' => true,
            'label' => 'Биография',
            'config' => [
                'type' => 'text',
                'rows' => 8,
                'cols' => 60
            ]
        ],
        'publications' => [
            'exclude' => true,
            'label' => 'Публикации (Заголовок|Ссылка)',
            'config' => [
                'type' => 'text',
                'rows' => 5,
                'cols' => 60,
            ]
        ],
    ]);
});
