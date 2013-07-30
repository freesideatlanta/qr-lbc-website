<?php

/**
 * Represents a user's identity on isodev.us, complete with authentication.
 * 
 * This class represents an identity that needs to be authenticated.
 * Note that this is NOT a model for a user on the site. It is an agent
 * that verifies the identity of a user.
 */

class QratitudeUserIdentity extends CUserIdentity
{
    /**
     * @var integer $_id The primary key of the record for a given user
     */

    private $_id;

    /**
     * Returns an id that represents the user.
     *
     * Returns the user id. For our purposes, this is
     * is the primary key in the database for the user
     * record.
     *
     * @return int The user id (as primary key)
     */

    public function getId()
    {
        return $this->_id;
    }

    /**
     * Authenticates a user
     *
     * @return boolean If authentication was successful
     */

    public function authenticate()
    {
        // check to see if email is in db
        $user = UserModel::model()->find('email=:email',
                                    array(':email'=>$this->username));

        if ($user == null || $user->email !== $this->username)
        {
            // email not in record
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }
        else if(!Yii::app()->hasher->checkPassword($this->password,
                                                   $user->hash))
        {
            // password incorrect
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        }
        else
        {
            // authentication successful
            $this->errorCode=self::ERROR_NONE;
            $this->_id = $user->id;
        }
        
        return !$this->errorCode;
    }
}
