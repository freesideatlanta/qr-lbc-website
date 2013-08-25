<?php

/**
 * Renders a single asset.
 */

class ViewAction extends CAction
{
    public function run($id)
    {
        if (!is_numeric($id) || !preg_match('/^[1-9][0-9]*$/', $id))
        {
            throw new CHttpException(400, "Specify an id for asset.");
        }

        $id = (int)$id;

        // $asset = Yii::app()->get('/assets/'.$id);
        $asset = require(dirname(__FILE__).'/../../phplib/dummy.php');

        $this->controller->render('view', array('asset'=>$asset[$id]));
    }
}
