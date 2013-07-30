<?php
class LoginAction extends ActiveFormAction
{
    protected function afterGoodSubmission($model)
    {
        Yii::log($model->email." has logged in.","info",
            "application.controllers.user");
        
        $return_url = Yii::app()->user->getReturnUrl();
        $this->controller->redirect( $return_url );
    }
}