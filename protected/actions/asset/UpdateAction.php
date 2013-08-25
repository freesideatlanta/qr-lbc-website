<?php

class UpdateAction extends CAction
{
    public function run()
    {
        $model = new AssetFormModel();

        // collect input
        if(isset($_POST["AssetFormModel"]))
        {
            $model->attributes=$_POST["AssetFormModel"];
            
            if (!$model->validate() ||
                !$this->putAsset($model))
            {
                $this->controller->render('create',
                    array('model'=>$model));
            }
        }
        else
        {
            $this->controller->render('create',
                array('model'=>$model));
        }
    }

    public function putAsset($model)
    {
        try
        {
            // Yii::app()->uploadPhoto($model->photo);

            Yii::app()->put("/asset/".$model->id, $model->toArray());
        }
        catch(Exception $e)
        {
            // silently return, since rendering the form
            // again should show user error.
            return false;
        }

        return true;
    }    
}
