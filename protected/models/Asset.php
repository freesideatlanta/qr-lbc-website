<?php

class Asset extends EActiveResource
{
    public $id;

    public static function model($classname=__CLASS__)
    {
        return parent::model($classname);
    }

    public function rest()
    {
        return CMap::mergeArray(
            parent::rest(),
            array(
                'resource'=>'asset',
                'idProperty'=>'id'
            ));
    }


    public function properties()
    {
        return array_merge(
            array(
                'tag'=>array('type'=>'string'),
                'category'=>array('type'=>'string'),
                'description'=>array('type'=>'string'),
                'size'=>array('type'=>'string'),
                'quantity'=>array('type'=>'integer'),
                'condition'=>array('type'=>'string'),
                'color'=>array('type'=>'string'),
                'name'=>array('type'=>'string'),
                'featured'=>array('type'=>'boolean')
            ),
            // These attributes are set via protected/confi/attrs.php
            // End user can update attrs.php using the form @ /site/attributes
            Yii::app()->params["customAttrs"]
        );
    }

    public function rules()
    {
        return array(
             array('quantity','numerical','integerOnly'=>true),
        );
    }

     public function attributeLabels()
     {
         return array(
            'name'=>'Name',
            'category'=>'Category',
            'description'=>'Description',
            'size'=>'Size',
            'quantity'=>'Quantity',
            'condition'=>'Condition',
            'color'=>'Color',
            'tag'=>'Tag',
         );
     }

}

