<?php

/**
 * Makes sure user is logged in and has a cetain role.
 */

class AuthFilter extends CFilter
{
    public $role = "admin";

    public function preFilter($filterChain)
    {
        $user = Yii::app()->user;

        $ok  = true;
        $ok &= !$user->isGuest;

        if (!is_null($this->role))
        {
            $ok &= QratitudeHelper::checkRole($user->id, $this->role);
        }

        if (!$ok)
        {
            $user->loginRequired();
            return false;
        }

        $filterChain->run();
        return true;
    }
}
