<?php

/**
 * Verifies a user's email
 */

class VerifyAction extends CAction
{
    public function run($code = null)
    {        
        if ($code == null)
        {
            // Why verify no one?
            $this->controller->redirect(
                $this->controller->createUrl('/site/index'));
        }
        
        // Clean gobbledygook off of email in URL, and check database.
        $email = Yii::app()->decrypt($code);
        $user = UserModel::model()->find( 'email=:email',
            array(':email'=>$email) );
        
        $data = array(
            'email'=>$email,
            'success'=>($user != null)
        );

        if ($user)
        {
            /* Record exists. Since this code could only be used
            by someone with access to the email account in question,
            the email is valid and now verified. */
            
            $user->verified = true;
            $data['success'] = $user->save();
        }
        
        $this->controller->render('verifyResult', $data);
    }
}