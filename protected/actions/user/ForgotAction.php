<?php

/**
 * Helps user recover a password
 */

class ForgotAction extends ActiveFormAction
{
    protected function afterGoodSubmission($model)
    {
        $model->sendResetInstructions();

        if (!$model->hasErrors())
        {
            $this->controller->render('resetInstructionsSent',
                array('email'=>$model->email));

            return true;
        }
        
        return false;
    }
}