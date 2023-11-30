<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name' => 'Hora da Papa',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => ['parsers' => [
        'application/json' => 'yii\web\JsonParser',
    ], 'api' => ['class' => 'backend\modules\api\ModuleAPI']],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
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
                [
                    'class' => 'yii\rest\UrlRule', 'controller' => 'api/user', 'pluralize' => false,
                    'extraPatterns' => [
                        'GET login' => 'login',
                        'POST register' => 'register',

                    ],
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/review'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/request'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/plate'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/meal'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/invoice'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/helpticket'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/favorite'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/dinner'],
            ],
        ],
    ],
    'params' => $params,
];
