<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */

class UserIdentity extends CUserIdentity
{
    private $_token;
    private $_backid;

	/**
	 * Authenticates user to back end.
	 * @return boolean whether authentication succeeds.
     */

	public function authenticate()
    {
        $json_php = QratitudeHelper::authenticate(
            $this->username,
            $this->password
        );

        if (is_null($json_php) ||
            !isset($json_php["token"], $json_php["userid"]))
        {
            return false;
        }

        $this->_token   = $json_php["token"];
        $this->_backid  = $json_php["userid"];
        
        return true;
    }

    /**
     * Returns token associated with the user identity
     * @return string Token
     */

    public function getToken()
    {
        return $this->_token;
    }

    /**
     * Returns id used by the back end
     * @return string
     */

    public function getBackId()
    {
        return $this->_backid;
    }
}
