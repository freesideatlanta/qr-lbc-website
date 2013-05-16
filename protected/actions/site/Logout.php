<?php

class Logout extends CAction
{
    /**
     * Logs out the current user and redirect to homepage.
     */

    public function run()
    {
        Yii::app()->user->logout();
        $this->controller->redirect(Yii::app()->homeUrl);
    }
}
