<?php

use yii\web\JsonParser;
use yii\web\JsonResponseFormatter;
use yii\web\Response;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'reezonly-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'v1\admin' => [
            'basePath' => '@app/modules/v1/admin',
            'class' => \app\modules\v1\admin\Module::class,
        ],
        'v1\catalog' => [
            'basePath' => '@app/modules/v1/catalog',
            'class' => \app\modules\v1\catalog\Module::class,
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => app\models\User::class,
            'enableAutoLogin' => false,
            'enableSession' => false,
        ],
        'request' => [
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => JsonParser::class,
            ],
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'class' => Response::class,
            'formatters' => [
                Response::FORMAT_JSON => [
                    'class' => JsonResponseFormatter::class,
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                'PUT,PATCH api/v1/admin/catalog/<id>' => 'v1\admin/catalog/update',
                'DELETE api/v1/admin/catalog/<id>' => 'v1\admin/catalog/delete',
                'GET,HEAD api/v1/admin/catalog/<id>' => 'v1\admin/catalog/view',
                'POST api/v1/admin/catalog' => 'v1\admin/catalog/create',
                'GET,HEAD api/v1/admin/catalog' => 'v1\admin/catalog/index',
                'api/v1/admin/catalog/<id>' => 'v1\admin/catalog/options',
                'api/v1/admin/catalog' => 'v1\admin/catalog/options',

                'GET,HEAD api/v1/catalog/<id>' => 'v1\catalog/catalog/view',
                'GET,HEAD api/v1/catalog' => 'v1\catalog/catalog/index',
                'api/v1/catalog/<id>' => 'v1\catalog/catalog/options',
                'api/v1/catalog' => 'v1\catalog/catalog/options',

            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
