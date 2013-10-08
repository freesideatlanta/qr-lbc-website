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
     * @var string $username The user's username address
     */
    public $username;

    /**
     * @var string $password The user's unencrypted password to be hashed
     */
    public $password;

    /**
     * @var UserIdentity $_identity Used to authenticate user.
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
            array('username, password', 'required'),
            array('username', 'length','min'=>2),
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
            'username'=>'Username',
            'password'=>'Password',
        );
    }

    /**
     * Authenticates a user, logging him in if successful
     *
     * The parameters in this method are present by convention,
     * but are not used. This method is triggered on password
     * validation.
     *
     * @param string $attribute Attribute to validate
     * @param array $params Data passed to validator
     */
    public function authenticate($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $this->_identity = new UserIdentity(
                $this->username, $this->password);

            if(!$this->_identity->authenticate())
            {
                $this->addError('password',
                                'Incorrect username or password.');
            }
            else
            {
                Yii::app()->user->login($this->_identity);
            }
        }
    }
}
