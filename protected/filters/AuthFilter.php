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

        $ok   = true;
        $ok  &= !$user->isGuest;
        $ok  &= QratitudeHelper::checkRole($user->id, $this->role);

        return $ok;
    }
}
