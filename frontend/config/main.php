<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
                ['class' => 'yii\rest\UrlRule', 'controller' => 'street'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'group'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'house'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'man'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'man_house'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'price'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'counter'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'indication'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'pay']
            ],
        ],
    ],
    'params' => $params,
];
