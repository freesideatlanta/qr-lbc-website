<?php

/**
 * Lists all users
 */

class IndexAction extends CAction
{
    public function run()
    {        
        $dataProvider=new CActiveDataProvider('UserModel');
        $this->controller->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }
}