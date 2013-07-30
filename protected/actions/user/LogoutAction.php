<?php

/**
 * Ends session for user and logs him or her out
 */

class LogoutAction extends CAction
{
    public function run()
    {
        $user = Yii::app()->user;
        $returnUrl = $user->getReturnUrl();
        $user->logout( true );
        $this->getController()->redirect( $returnUrl );
    }
}