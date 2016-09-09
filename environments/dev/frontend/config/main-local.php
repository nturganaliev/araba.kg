<?php

$config = [
//    'catchAll' => ['site/offline'],
    'modules' => [
        'account' => [
            'class' => 'frontend\modules\account\Account',
        ]
    ],
    'as beforeRequest' => [
        'class' => 'frontend\components\LanguageHandler',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'TKLJLDFJW)(*W_#$W@#)_DFKLSJDF:LSJDFL:KJSDFLKJSLKJDF',
        ],
        'imageCache' => [
            'class' => 'iutbay\yii2imagecache\ImageCache',
            'sourcePath' => '@app/../uploads/cars',
            'sourceUrl' => '@web/../../uploads/cars',
            'thumbsPath' => '@app/web/thumbs',
            'thumbsUrl' => '@web/thumbs',
            'sizes' => [
                'thumb' => [165, 120],
                'medium' => [450, 450],
                'large' => [600, 600],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
//            'suffix' => '.html',
            'rules' => [
                '' => 'site/index',
                'logout' => 'site/logout',
                'signup' => 'site/signup',
                'upload' => 'site/upload',
                'test' => 'site/test',
                'login' => 'site/login',
                'account/default' => 'account/car/index',
                'account/settings' => 'account/default/settings',
                'account/update-settings' => 'account/default/update-settings',
                'account/update-password' => 'account/default/update-password',
                'account/refill-balance' => 'account/default/refill-balance',
                'car/series' => 'car/series',
                'car' => 'car/search',
                'car/fieldset' => 'car/fieldset',
                'moto-type' => 'moto-type/index',
                'moto-type/create' => 'moto-type/create',
                'moto-type/delete' => 'moto-type/delete',
                'moto-type/view' => 'moto-type/view',
                'moto-type/update' => 'moto-type/update',
                'thumbs/<path:.*>' => 'site/thumb',
            ],
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
