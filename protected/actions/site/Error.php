<?php

class Error extends CAction
{
    /**
     * This is the action to handle external exceptions.
     */

    public function run()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->controller->render('error', $error);
        }
    }
}
