<?php

Yii::setPathOfAlias('actions',dirname(__FILE__).'/../actions');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'LBC',
	'theme'=>'default',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
        'application.components.*',
        'application.extensions.EActiveResource.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
            'password'=>'abc',
            'newFileMode'=>0666,
            'newDirMode'=>0777,
			// If removed, Gii defaults to localhost only.
			'ipFilters'=>array('*','::1'),
            'generatorPaths'=>array(
                'ext.gtc'
			),
		),
	),

	// application components
	'components'=>array(
        'activeresource'=>array(
            'class'=>'EActiveResourceConnection',
            'site'=>'http://localhost:3000',
            'contentType'=>'application/json',
            'acceptType'=>'application/json',
         ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
			'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                'site/page/<view:\w+>'=>array('site/page'),
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, info, trace',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
       'adminEmail'=>'zyrolasting@gmail.com',
       'customAttrs'=>include('attrs.php'),
    ),
);
