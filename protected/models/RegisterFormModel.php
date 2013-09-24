<?php

/**
 * Stores information from a form used to register a new user.
 *
 * When the user wants an account
 *
 * @author Sage Gerard
 * @version 1.0
 * @package application.models
 */

class RegisterFormModel extends CFormModel
{
    /**
     * @var string $username The user's name
     */

    public $username;

    /**
     * @var string $password The user's unencrypted password.
     */

    public $password;

    /**
     * @var string $password_confirm An unencrypted password used to verify the user is sure about his password choice.
     */

    public $password_confirm;

    /**
     * Returns business rules Yii uses for this model
     *
     * @return array Business rules Yii uses for this model
     */

    public function rules()
    {
        return array(
            array('username, password, password_confirm', 'required'),
            array('password_confirm','compare',
                    'compareAttribute'=>'password'),
            array('username','length',
                  'min'=>2,'max'=>15),
            array('password, password_confirm','length',
                  'min'=>6,'max'=>20),
        );
    }

    /**
     * Returns human friendly labels for model attributes.
     *
     * @return array Human-friendly labels used for model atttributes
     */

    public function attributeLabels()
    {
        return array(
            'username'=>'Username',
            'password'=>'Password',
            'password_confirm'=>'Confirm Password',
        );
    }
    
    /**
     * Registers user into the system
     */
    public function register()
    {
        QratitudeHelper::createUser($this->username, $this->password);
        return true;
    }
}
