<?php

class DeleteAction extends CAction
{
    public function run($id)
    {
        Yii::app()->delete("/asset/$id");
    }    
}
