<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
     */

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
                'class'=>'CViewAction',
                'layout'=>'//layouts/column2'
            ),
            'index'=>array(
                'class'=>'actions.site.Index',
             ),
            'contact'=>array(
                'class'=>'actions.site.Contact',
             ),
            'attributes'=>array(
                'class'=>'actions.site.Attributes',
             ),
            'error'=>array(
                'class'=>'actions.site.Error',
             ),
             'donate'=>array(
                 'class'=>'actions.site.DonateAction',
             ),
             'request'=>array(
                 'class'=>'actions.site.RequestAction',
             ),
		);
	}



}
