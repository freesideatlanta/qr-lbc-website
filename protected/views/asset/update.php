<?php
/* @var $this AssetController */

$this->breadcrumbs=array(
	'Asset'=>array('/asset'),
	'Update',
);

$this->renderPartial('_form',array(
    'asset'=>$asset,
));
