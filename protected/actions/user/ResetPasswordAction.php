<?php

/**
 * Resets a user's password in conjunction with {@link ForgotFormAction}
 */

class ResetPasswordAction extends ActiveFormAction
{
    private $_email;
    
    public function run($code = null)
    {
        // Do not reset password for no-one.
        if ($code == null)
        {
            $this->getController()->redirect('/user/forgot');
        }
        
        $this->_email = Yii::app()->decrypt($code);
        
        // We need to process the active form the view will be using.
        parent::run();
    }
    
    protected function afterGoodSubmission($model)
    {        
        $success = $model->resetPassword($this->_email) &&
                    !$model->hasErrors();

        if (!$success)
        {
            Yii::log("Failed to reset password for $this->_email.",
                     "warning","application.controllers.user");
        }
        else
        {
            Yii::app()->mail($this->_email, 'Password Reset',
                'passwordReset', array());
        }
        
        $this->controller->render('resetResult',
            array('success'=>$success));
        
        return true; // Do not let ActiveFormAction::showForm() run.
    }
}