<?php

/**
 * Registers a user for the site
 */

class RegisterAction extends ActiveFormAction
{
    protected function afterGoodSubmission($model)
    {
        $model->register();
        $this->controller->render('registerSuccess',
            array('email'=>$model->email));
        return true;
    }
}