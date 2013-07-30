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


    public function array_column($array)
    {
        

    }

    public function properties()
    {
        // Extra attributes set in protected/config/attrs.php
        $custom_attr = Yii::app()->params["customAttrs"];
        return array_column( $custom_attr, "properties", "name" );
    }

    public function rules()
    {
        return array(
             array('quantity','numerical','integerOnly'=>true),
        );
    }

     public function attributeLabels()
     {
         $custom_attr = Yii::app()->params["customAttrs"];
         return array_column( $custom_attr, "label", "name" );
     }

}

