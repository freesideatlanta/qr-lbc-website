<?php

class AssetController extends Controller
{
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
    }
    */

	public function actions()
	{
		return array(
			'index'=>array(
				'class'=>'actions.asset.IndexAction',
			),
			'create'=>array(
				'class'=>'actions.asset.CreateAction',
			),
			'read'=>array(
				'class'=>'actions.asset.ReadAction',
			),
			'update'=>array(
				'class'=>'actions.asset.UpdateAction',
			),
			'delete'=>array(
				'class'=>'actions.asset.DeleteAction',
			),
		);
	}
}
