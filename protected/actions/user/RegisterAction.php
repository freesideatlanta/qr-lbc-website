<?php

/**
 * Registers a user for the site
 */

class RegisterAction extends CAction
{
    protected function run()
    {
        $model = new RegisterFormModel;

        if (isset($_POST["RegisterFormModel"]))
        {
            $model->attributes = $_POST["RegisterFormModel"];

            if ($model->validate() && $model->register())
            {
                Yii::app()->user->setFlash(
                    'success',
                    "Account registered"
                );
            }
        }

        $this->controller->render(
            'register_form',
            array(
                'model'=>$model
            )
        );
    }
}
