<?php
/* @var $this AssetController */

$this->breadcrumbs=array(
	'Asset'=>array('/asset'),
	'Create',
);


$this->renderPartial('_form',array(
    'asset'=>$asset,
));
