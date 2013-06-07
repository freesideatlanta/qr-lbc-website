<?php

class ShopController extends Controller
{
	public function filters()
	{
        return array(

        );
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
            'index'   =>'actions.shop.IndexAction',
            'donate'  =>'actions.shop.DonateAction',
            'request' =>'actions.shop.RequestAction',
            'item'    =>'actions.shop.ItemAction'
		);
	}
}
