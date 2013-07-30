<?php

/**
 * Shows user profile
 */

class ViewAction extends CAction
{
    public function run($id)
    {        
        $this->controller->render('view',array(
            'model'=>$this->controller->loadModel($id),
        ));
    }
}