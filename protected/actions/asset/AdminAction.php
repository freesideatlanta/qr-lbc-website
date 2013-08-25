<?php

/**
 * Renders paginated assets that can be manipulated from a single
 * console. 
 */

class AdminAction extends CAction
{
    public function run()
    {
        $assets = require(dirname(__FILE__).'/../../phplib/dummy.php'); // Yii::app()->get('/asset');
        $this->controller->render('admin', array('assets'=>$assets));
    }
}
