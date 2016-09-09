<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'homeUrl' => '/employee',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'i18n' => Zelenin\yii\modules\I18n\Module::className()
    ],
    'components' => [
        'user' => [
            'identityClass' => 'backend\models\Employee',
            'enableAutoLogin' => false,
        ],
        'imageCache' => [
            'class' => 'iutbay\yii2imagecache\ImageCache',
            'sourcePath' => '@app/web/uploads',
            'sourceUrl' => '@web/uploads',
            'thumbsPath' => '@app/web/thumbs',
            'thumbsUrl' => '@web/thumbs',
            'sizes' => [
                'thumb' => [100, 100],
                'medium' => [250, 250],
                'large' => [600, 600],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'thumbs/<path:.*>' => 'site/thumb',
            ]
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
    ],
    'params' => $params,
];
