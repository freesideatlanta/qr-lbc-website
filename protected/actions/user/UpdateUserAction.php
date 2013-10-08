<?php

/**
 * Edits a user
 */
class UpdateUserAction extends CAction
{
    /**
     * Presents a form to update a user
     *
     * @param string $id ID of user on back end
     */
    public function run($id)
    {
        $model=$this->controller->loadModel($id);

        // Uncomment if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['UserModel']))
        {
            $model->attributes=$_POST['UserModel'];
            if($model->save())
            {
                $this->controller->redirect(
                    array('view','id'=>$model->id));
            }
        }

        $this->controller->render('update',array(
            'model'=>$model,
        ));
    }
}
