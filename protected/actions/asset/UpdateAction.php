<?php

/**
 * Edits existing asset
 */

class UpdateAction extends CAction
{
    public function run($id)
    {
        $asset = null;
        $yii   = Yii::app();

        $yii->clientScript->registerScriptFile(
            $this->controller->createUrl('/js/asset-form.js'),
            CClientScript::POS_END
        );

        $images = CUploadedFile::getInstancesByName('images');

        // collect input
        if(isset(
            $_POST["Asset"],
            $_POST['AssetCustomAttribute']
        ))
        {
            // Construct replacement
            $asset = new Asset();
            
            $asset->id = $id;
            $asset->populate(
                 $_POST["Asset"],
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
            $asset = QratitudeHelper::getAsset($id);
        }

        $this->controller->render('update', array('asset'=>$asset));
    }
}
