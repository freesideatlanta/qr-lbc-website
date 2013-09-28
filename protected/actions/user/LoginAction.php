<?php

/**
 * Creates new session for authenticated user.
 */

class LoginAction extends CAction
{
    protected function run()
    {
        $model = new LoginFormModel();

        if (isset($_POST["LoginFormModel"]))
        {
            $model->attributes = $_POST["LoginFormModel"];

            if ($model->validate())
            {
                $id = new UserIdentity($model->username, $model->password);

                if ($id->authenticate($model->username, $model->password))
                {
                    // Store token
                    $user = Yii::app()->user;

                    $user->setState('backid', $id->getBackId());
                    $user->setState('token', $id->getToken());

                    // Head back to where the user was before.
                    //$return_url = $user->getReturnUrl();
                    //$this->controller->redirect($return_url);

                    $this->controller->redirect('/');
                }
                else
                {
                    Yii::app()->user->setFlash("error",
                        "Incorrect username or password");
                }
            }
        }

        $this->controller->render('login',array(
            'model'=>$model,   
        ));
    }
}
