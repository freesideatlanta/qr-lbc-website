<?php

/**
 * Takes a user's email and sends instructions on how to reset a password.
 *
 * @author Sage Gerard
 * @version 1.0
 * @package application.models
 */

class ForgotFormModel extends CFormModel
{
    public $email;
    
    public function rules()
    {
        return array(
            array('email', 'required'),
            array('email', 'email'),
            array('email', 'length', 'max'=>256)
        );
    }
    
    public function attributeLabels() 
    {
        return array(
            array(
                'email'=>'Email',
            ),
        );
    }

    public function sendResetInstructions()
    {
        if (!UserModel::model()->exists('email=:email',
                    array(':email'=>$this->email)))
        {
            $this->addError('email',"This email is not registered.");
            
            return false;
        }
        else
        {            
            $key = Yii::app()->params['encodeKey'];
            $code = Yii::app()->encrypt($this->email);            
            Yii::app()->mail($this->email, 'Resetting your password',
                'resetInstructions', array('code' => $code));
        }
        
        return true;
    }
}
