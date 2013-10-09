<?php

/**
 * Makes sure user is logged in and has a cetain role.
 *
 * @author Sage Gerard
 */

class AuthFilter extends CFilter
{
    public $role = "admin";

    /**
     * Redirects to login form if user is not authorized
     *
     * When this filter is applied to an action, it will
     * check if the current user is logged in. If
     * {@link AuthFilter::role} is not NULL, the filter
     * will also check if the user has the role specified
     * in {@link AuthFilter::role}.
     *
     * If the user is not authorized, the filter drops
     * the current request and redirects the user
     * to the login form.
     *
     * @param CFilterChain $filterChain Set of filters on action
     * @return bool True if user is authorized
     */
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

        return true;
    }
}
