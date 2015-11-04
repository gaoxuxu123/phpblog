<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
 
return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'backend\controllers',
    'components' => [
        'assetManager' => [
            'basePath' => '@webroot/backend/web/assets',
            'baseUrl' => '@web/backend/web/assets'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [

                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'rules' => [
                             'test/<id:\d+>.html' => 'test/articlelist',
                             'article/<id:\d+>.html' => 'article/articledetail',
                             'database/tabcolumninfos/<tableName:\w+>' => 'database/tabcolumninfos',
                             'database/tabinfos/<tableName:\w+>' => 'database/tabinfos',
                             'task/<id:\d+>' => 'task/taskdownload',
                           ]
        ],
    ],
    'params' => $params,
];