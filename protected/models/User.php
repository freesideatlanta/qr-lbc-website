<?php

class User extends EActiveResource
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
        return array(
            'email'=>array('type'=>'string'),
            'hash'=>array('type'=>'string'),
        );
    }

    public function rules()
    {
        return array(
            array('email','email'),
            array('hash,email','unsafe'),
            array('hash,email','required'),
            array('hash', 'length', 'min'=>59), // bcrypt hash length req.
        );
    }
}

