<?php
return [
    'id' => 'console',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'console\controllers',
    'bootstrap' => ['console\config\Setup'],
    'controllerMap' => [
        'generator' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' =>['common\migrations\db'],
            'migrationTable' => 'system_db_migration',
            'generatorTemplateFiles' => [
                'create_table' => '@common/addons/giiant/templates/createTableMigration.php',
                'drop_table' => '@yii/views/dropTableMigration.php',
                'add_column' => '@yii/views/addColumnMigration.php',
                'drop_column' => '@yii/views/dropColumnMigration.php',
                'create_junction' => '@yii/views/createTableMigration.php',
            ]
        ],
        'batch' => [
            //'class' => 'schmunk42\giiant\commands\BatchController',
            'class' => 'common\addons\giiant\CBatchController',
            'overwrite' => true,
            'interactive' => 0,
            'modelNamespace' => 'common\\models\\entity',
            'modelQueryNamespace' => 'common\\models\\entity\\query',
            'crudControllerNamespace' => 'backend\\modules\\entity\\controllers',
            'crudSearchModelNamespace' => 'common\\models\\entity\\search',
            'crudViewPath' => '@backend/modules/entity/views',
            'crudPathPrefix' => '/entity/',
            'crudTidyOutput' => true,
            'useTranslatableBehavior' => true,
            'crudAccessFilter' => false,
            'crudProviders' => [
                'common\addons\giiant\generators\crud\providers\extensions\EditorProvider',
                'common\addons\giiant\generators\crud\providers\extensions\ThumbnailProvider',
                'common\addons\giiant\generators\crud\providers\extensions\StatusProvider',
                'common\addons\giiant\generators\crud\providers\extensions\PriceTypeProvider',
                'common\addons\giiant\generators\crud\providers\core\CallbackProvider',
                'schmunk42\\giiant\\generators\\crud\\providers\\core\\OptsProvider',
                'schmunk42\\giiant\\generators\\crud\\providers\\extensions\\DateTimeProvider',
            ],
            'tablePrefix' => '',
            'tables'=> [
                /* List of tables */
                'products',
                'directions',
                'faq',
                'club',
                'article',
                'user',
                'dance_schemes_category',

                'dance_schemes',
                'dance_schemes_attachment',
                'dance_schemes_lang',

                /*'halls_prices',
                'dance_event',
                'dance_event_ticket_price',
                'dance_event_residence_price'*/
                /*'articles',
                'articles_lang',
                'articles_tag',
                'articles_tag_assn',

                'club',
                'club_lang',

                'dance_event',
                'dance_event_attachment',
                'dance_event_lang',

                'directions',
                'directions_attachment',
                'directions_category',
                'directions_lang',

                'faq',
                'faq_lang',

                'halls',
                'halls_attachment',
                'halls_lang',
                'halls_prices',

                'products',
                'products_category',
                'products_lang',

                'teachers',
                'teachers_lang',

                'news',
                'news_lang',

                'programm',
                'programm_exercise',
                'programm_exercise_lang',
                'programm_lang',*/
            ]
        ],
        'command-bus' => [
            'class' => 'trntv\bus\console\BackgroundBusController',
        ],
        'message' => [
            'class' => 'console\controllers\ExtendedMessageController'
        ],
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@common/migrations/db',
            'migrationTable' => '{{%system_db_migration}}'
        ],
        'rbac-migrate' => [
            'class' => 'console\controllers\RbacMigrateController',
            'migrationPath' => '@common/migrations/rbac/',
            'migrationTable' => '{{%system_rbac_migration}}',
            'templateFile' => '@common/rbac/views/migration.php'
        ],
    ],
];
