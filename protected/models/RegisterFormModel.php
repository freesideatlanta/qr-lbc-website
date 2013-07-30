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
     * @var string $email The user's email
     */

    public $email;

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
            array('email, password, password_confirm', 'required'),
            array('password_confirm','compare',
                    'compareAttribute'=>'password'),
            array('password, password_confirm','length',
                  'min'=>6,'max'=>20),

            array('email', 'email'),
            array('email', 'length', 'max'=>256)
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
            'email'=>'Email',
            'password'=>'Password',
            'password_confirm'=>'Confirm Password',
        );
    }
    
    /**
     * Registers user for isodev.us
     *
     * Registers a new account into isodev.us. This involves:
     *  - Creating a new UserModel, if the email is not already stored.
     *  - Hashes the password
     *  - Verifies the email
     *  - Sends notification emails where appropriate
     *
     */
    public function register()
    {
        
        $user = new UserModel;
        $app = Yii::app();
        
        $user->email = $this->email;
        $user->referrer_id = $app->randomString->generate(8);
        
        if ($user->exists('email=:email',array(':email'=>$this->email)))
        {
            $this->addError('email','This address already exists. '.
            'Did you forget your password?');
        }
        else
        {        
            // verify email domain
            list($userName, $mailDomain) = explode('@', $user->email);
            if (checkdnsrr($mailDomain, 'MX'))
            {
                $user->hash=$app->hasher->hashPassword($this->password);
                
                if ( $user->save() )
                {
                    // ask user to verify email address
                    $verify_hash = $app->encrypt($user->email);
                    
                    $email = $app->mail($user->email,
                        'Registration Successful', 'userWelcome',
                            array(
                            'verify_hash' => $verify_hash,
                            'referrer_id' => $user->referrer_id
                            )
                        );
                }
                else
                {         
                    $errors = var_export($user->getErrors());
                    Yii::log($errors,'error','system.user.register');
                    
                    throw new CHttpException(500,
                    'Yikes! An internal error occured. '.
                    'Please try again later.');
                }
            }
            else
            {
                $this->addError('email','Invalid email address.');
            }
        }
    }
}
