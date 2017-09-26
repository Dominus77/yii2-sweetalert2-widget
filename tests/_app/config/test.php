<?php

return [
    'id' => 'yii2-sweetalert2-widget-tests',
    'basePath' => dirname(__DIR__),
    'language' => 'en-US',
    'aliases' => [
        '@dominus77/sweetalert2' => dirname(dirname(dirname(__DIR__))) . '/',
        '@tests' => dirname(dirname(__DIR__)),
        '@vendor' => VENDOR_DIR,
        '@bower' => VENDOR_DIR . '/bower',
    ],
    'modules' => [
        'user' => [
            'class' => 'Da\User\Module',
            'administrators' => ['user'],
        ],
    ],
    'components' => [
        'assetManager' => [
            'basePath' => __DIR__ . '/../assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
        ],
    ],
    'params' => [],
];