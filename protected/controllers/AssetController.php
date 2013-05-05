<?php

class AssetController extends Controller
{
	public function actionAdmin()
	{
		$this->render('admin');
	}

	public function actionCreate($name)
    {
        $a = new Asset();
        $a->name = $name;

        $a->save();
    }	

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionRead()
	{
		$this->render('read');
	}

	public function actionUpdate()
	{
		$this->render('update');
	}

	public function actionView()
	{
		$this->render('view');
	}

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

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
