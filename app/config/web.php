<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Yii2 KeenTheme', // override the default appTitle
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'uhKa9ou9ajzg-SJDGtawtpqnk1ciDJMX',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'session' =>[
            'class'         => 'yii\web\DbSession',
            'timeout' => (3*60), //delete online after 3 minutes no action
            // 'gcProbability' => 1, //live server doesnt have default - set garbage collection probability for live server
            'writeCallback' => function ($session) {  
                return [ 
                   'user_id' => Yii::$app->user->id, 
                   'ip' => Yii::$app->request->getUserIp(), 
                ];
            },
            // 'sessionTable' => 'session', 
        ],
        'on afterAction' => function ($event) {
            Yii::$app->session;
        },
        'assetManager' => [
            'forceCopy' => false,
            'linkAssets' => true,
            'appendTimestamp' => false,
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'sourcePath' => '@app/themes/keen_demo_1/assets/assetsfiles/plugins/global/',
                    'js' => ['plugins.bundle.min.js']
                ],  
                'yii\bootstrap5\BootstrapAsset' => [
                    'sourcePath' => '@app/themes/keen_demo_1/assets/assetsfiles/plugins/global/',
                    'css' => ['plugins.bundle.min.css']
                ],
            ]
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true, // false - to send real mails
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
            'showScriptName' => false,
            // 'enableStrictParsing' => false,
            // 'suffix' => '/',
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
            ],
            'rules' => [

                'site' => 'site/index',
                'about' => 'site/about',
                'contact' => 'site/contact',

                '<controller>' => '<controller>/index',
                '<controller>/<action>/<id:\d+>' => '<controller>/<action>',
                '<controller>/<action>' => '<controller>/<action>',
            ],
        ],
        
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => [
                        // '@app/views', 
                        '@app/themes/keen_demo_1/views', 
                    ],
                    '@app/widgets' => [
                        // '@app/widgets', 
                        '@app/themes/keen_demo_1/widgets'
                    ],
                ],
            ],
        ],
        
        'Role'  => ['class' => 'app\components\Role'], 
        'Navigation'  => ['class' => 'app\components\Navigation'], 
       
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'generators' => [
            'crud' => [ // generator name
                'class' => 'app\gii\keentheme\generators\crud\Generator', // generator class
                'templates' => [
                    'keentheme_starter' => '@app/gii/keentheme/generators/crud/default', // template name => path to template
                ]
            ],
            'model' => [
                'class' => 'yii\gii\generators\model\Generator',
                'templates' => [ 
                    'keentheme_starter' => '@app/gii/keentheme/generators/model/default', 
                ]
            ],
        ],
    ];
}

return $config;
