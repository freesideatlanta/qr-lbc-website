<?php

class AssetController extends Controller
{
	// Uncomment the following methods and override them if needed
	public function filters()
    {
        return array(
			array(
                'filters.AuthFilter + create update delete',
				'role'=>null,
			),
		);
    }

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
            'view'=>array(
                'class'=>'actions.asset.ViewAction',
            ),
			'delete'=>array(
				'class'=>'actions.asset.DeleteAction',
            ),
            'tag'=>array(
                'class'=>'actions.asset.TagAction',
            ),
		);
	}
}
