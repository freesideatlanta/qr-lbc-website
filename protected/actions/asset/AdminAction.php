<?php

/**
 * Renders paginated assets that can be manipulated from a single
 * console. 
 */

class AdminAction extends CAction
{
    public function run()
    {
        $assets = Yii::app()->get('/assets');
        $this->controller->render('admin', array(''));
    }
}
