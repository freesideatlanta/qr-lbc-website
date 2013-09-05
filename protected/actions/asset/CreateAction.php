<?php

/**
 * Saves new asset from a form.
 */

class CreateAction extends CAction
{
    public function run()
    {
        $asset = new Asset();
        $yii   = Yii::app();

        $yii->clientScript->registerScriptFile(
            $this->controller->createUrl('/js/asset-form.js'),
            CClientScript::POS_END
        );

        // header('Content-Type: text/plain');
        // die(var_export($_POST));
        $images = CUploadedFile::getInstancesByName('images');

        // collect input
        if(isset(
            $_POST["AssetMetadata"],
            $_POST['AssetCustomAttribute'],
            $images
        ))
        {
            $asset->populate(
                 $_POST["AssetMetadata"],
                 $_POST['AssetCustomAttribute'],
                 $images
            );

            if ($asset->validate())
            {
                if (!$asset->save())
                {
                    throw new Exception('507',
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
            $asset->metadata->custom =
                AssetMetadata::getDefaultCustomAttrs();
        }

        $this->controller->render('create', array('asset'=>$asset));
    }
}
