<?php

class CreateAction extends CAction
{
    public function run()
    {
        $model = new AssetFormModel();

        // collect input
        if(isset($_POST["AssetFormModel"]))
        {
            if (isset($_POST['attr-names']) && isset($_POST['attr-vals']))
            {
                $combined = array_combine(
                    $_POST['attr-names'],
                    $_POST['attr-vals']);

                if ($combined === FALSE)
                {
                    $model->addError('pairs', 'All custom attributes must have values and'.
                        'vise-versa. Do not leave any blanks in the table below.');
                }

                $model->pairs = $combined;
                die(var_export($model->pairs));
            }
            
            $model->attributes=$_POST["AssetFormModel"];

            if (!$model->validate() ||
                !$this->postAsset($model))
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

    public function postAsset($model)
    {
        try
        {
            // Yii::app()->uploadPhoto($model->photo);

            Yii::app()->post("/asset", $model->toArray());
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
