<?php

/**
 * Allows administration of all users
 */

class AdminAction extends CAction
{
    public function run()
    {        
        $model=new UserModel('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['UserModel']))
        {
            $model->attributes=$_GET['UserModel'];
        }

        $this->controller->render('admin',array(
            'model'=>$model,
        ));
    }
}