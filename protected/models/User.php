<?php

class User extends EActiveResource
{
    public $id;

    public static function model($classname=__CLASS__)
    {
        return parent::model($classname);
    }

    public function rules()
    {
        return array(
            array('username','length', 'min'=>2),
            array('username','unsafe'),
        );
    }
}

