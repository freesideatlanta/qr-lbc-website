<?php

CHtml::$requiredCss = "is-required";

$this_file = dirname(__FILE__);

Yii::setPathOfAlias('actions',$this_file.'/../actions');
Yii::setPathOfAlias('filters',$this_file.'/../filters');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
	'basePath'=>$this_file.'/..',
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

    'behaviors'=>array(
        'MailBehavior'=>array(
            'class'=>'application.behaviors.MailBehavior',
            'from'=>'no-reply@qratitude',
            'subject_prefix'=>'QRatitude - ',
        ),
        'FlashBehavior'=>array(
            'class'=>'application.behaviors.FlashBehavior',
        ),
        'UrlCryptBehavior'=>array(
            'class'=>'application.behaviors.UrlCryptBehavior',
            'key'=>'f$%*dgB08Ef95oxz@$'
        ),
        'JsonRestClientBehavior'=>array(
            'class'=>'application.behaviors.JsonRestClientBehavior',
            'api_prefix'=>'http://localhost:8080/qratitude-service/api',
        ),
    ),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
            'allowAutoLogin'=>true,
            'loginUrl'=>array('user/login'),
		),
        'hasher'=>array (
            'class'=>'ext.phpass.Phpass',
            'hashPortable'=>false,
            'hashCostLog2'=>10,
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
        'email'=>array(
            'class'=>'ext.email.Email',
            'delivery'=>'php', //Use php mailer. 'debug' dumps a view.
        ),
		'db'=>array(
			'connectionString' => 'sqlite:'.$this_file.'/../data/testdrive.db',
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
    ),
);
