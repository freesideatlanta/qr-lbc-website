<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */

class UserIdentity extends CUserIdentity
{
    private $_token;

	/**
	 * Authenticates user to back end.
	 * @return boolean whether authentication succeeds.
     */

	public function authenticate()
    {
        $this->_token = QratitudeHelper::login(
            $this->username,
            $this->password
        );
        
        return !is_null($this->_token);
    }

    /**
     * Returns token associated with the user identity
     * @return string Token
     */

    public function getToken()
    {
        return $this->_token;
    }
}
