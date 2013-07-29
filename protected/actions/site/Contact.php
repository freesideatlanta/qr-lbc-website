<?php

class Contact extends CAction
{
    /**
     * Displays the contact page
     */

    public function run()
    {
        $this->controller->layout = '//layouts/main';

        $model=new ContactForm;

        if(isset($_POST['ContactForm']))
        {
            $model->attributes=$_POST['ContactForm'];
        
            if($model->validate())
            {
                $y = Yii::app();
                $y->mail(
                    $y->params['adminEmail'],
                    $model->subject,
                    'user_message',
                    array(
                        'name' => $model->name,
                        'email'=> $model->email,
                        'body' => $model->body,
                    ),
                    $model->email
                );

                $y->user->setFlash('contact','Thanks! We will respond to you as soon as possible.');
                $this->controller->refresh();
            }
        }

        $this->controller->render('contact',array('model'=>$model));
    }
}
