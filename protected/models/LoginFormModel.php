<?php
/**
 * Captures and processes login credentials for authentication.
 *
 * @author Sage Gerard
 * @version 1.0
 * @package application.models
 */

class LoginFormModel extends CFormModel
{
    /**
     * @var string $email The user's email address
     */

    public $email;

    /**
     * @var string $password The user's unencrypted password to be hashed
     */

    public $password;

    /**
     * @var boolean $rememberMe Whether or not to store login information in a cookie
     */

    public $rememberMe = false;

   /**
     * @var IsolateUserIdentity $_identity Yii {@link CIsolateUserIdentity} instance used to authenticate user.
     */

    private $_identity;

    /**
     * Returns Yii business rules for the model
     *
     * @return array Yii business rules for the model
     */

    public function rules()
    {
        return array(
            array('email, password', 'required'),
            array('email', 'email'),
            array('email', 'length','max'=>256),
            array('rememberMe', 'boolean'),
            array('password', 'authenticate'),
            array('password', 'length', 'min'=>6),
        );
    }

    /**
     * Returns human-friendly attribute labels
     *
     * @return array Human-friendly attribute labels
     */

    public function attributeLabels()
    {
        return array(
            'rememberMe'=>'Remember me',
        );
    }

    /**
     * Authenticates a user
     */

    public function authenticate($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $this->_identity = new UserIdentity($this->email, $this->password);

            if(!$this->_identity->authenticate())
            {
                $this->addError('password',
                                'Incorrect email or password.');
            }
            else
            {
                $duration=$this->rememberMe ? 3600*24*10 : 0; // 10 days
                Yii::app()->user->login( $this->_identity, $duration );
            }
        }
    }
}
