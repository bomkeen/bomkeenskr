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
          'urlManager' => [
            'class' => 'yii\web\urlManager',
            'enablePrettyUrl' => false,
            'showScriptName' => true,
     ],
        'urlManager' => [
            'enablePrettyUrl' => FALSE,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
         'urlManagerBackend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/skr/backend/web',
            'scriptUrl'=>'/skr/backend/web/index.php',
            'enablePrettyUrl' => false,
            'showScriptName' => true,
     ],
        'user' => [
            //'identityClass' => 'common\models\User',
            'identityClass' => 'dektrium\user\models\User',
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
       
    ],
    'modules' => [
       'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'user' => [
        'class' => 'dektrium\user\Module',
        'enableUnconfirmedLogin' => true,
        'confirmWithin' => 21600,
        'cost' => 12,
        'admins' => ['bomkeen']
    ]
    ],
    'params' => $params,
];
