<?php

/**
 * Models a form where a user can set a new password.
 * @author Sage Gerard
 * @version 1.0
 * @package application.models
 */

class ResetFormModel extends CFormModel
{
    public $password;
    public $password_confirm;
    
    public function rules()
    {
        return array(
            array('password, password_confirm', 'required'),
            
            array('password_confirm','compare',
                    'compareAttribute'=>'password'),
                    
            array('password, password_confirm','length',
                    'min'=>'6','max'=>'20'),
        );
    }
    
    public function attributeLabels()
    {
        return array(
            'password'=>'Password',
            'password_confirm'=>'Confirm Password',
        );
    }
    
    // Sets user's password to that defined in the attribute.
    // Returns true if successful.
    public function resetPassword($email)
    {
        $user = UserModel::model()->find('email=:email',
            array(':email'=>$email));
        
        if ($user == null)
        {
            $this->addError('password',
                            "{$email} is not in our records.");

            return false;
        }
        else
        {
            $user->hash = Yii::app()->hasher->
                                      hashPassword($this->password);
                                      
            return $user->save();
        }
    }
}
