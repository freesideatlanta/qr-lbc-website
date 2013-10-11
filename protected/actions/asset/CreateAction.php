<?php

/**
 * Saves new asset from a form.
 */

class CreateAction extends CAction
{
    public function run()
    {
        $asset = new Asset();
        $asset->scenario = 'create';

        $yii   = Yii::app();

        $yii->clientScript->registerScriptFile(
            $this->controller->createUrl('/js/asset-form.js'),
            CClientScript::POS_END
        );

        $images = CUploadedFile::getInstancesByName('images');

        // collect input
        if(isset(
            $_POST['Asset'],
            $_POST['AssetCustomAttribute'],
            $images
        ))
        {
            $asset->populate(
                 $_POST['Asset'],
                 $_POST['AssetCustomAttribute'],
                 $images
            );

            if ($asset->validate())
            {
                if (!$asset->saveNew())
                {
                    throw new CHttpException(500,
                            "Sorry! Something broke. Please try again.");
                }
                else
                {
                    $yii->user->setFlash('success', "Asset saved!");
                }
            }
        }
        else
        {
            $asset->custom = Asset::getDefaultCustomAttrs();
        }

        $this->controller->render('create', array('asset'=>$asset));
    }
}
