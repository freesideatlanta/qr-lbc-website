<?php

/**
 * Edits one asset in the inventory
 *
 * @author Sage Gerard
 */

class UpdateAction extends CAction
{
    /**
     * Displays form populated with existing asset data to edit.
     *
     * @param string $id ID of asset to edit as hex string
     * @return void
     */
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
            $old = QratitudeHelper::getAsset($id);

            $asset = clone $old;
            $asset->scenario = 'update';
            
            
            $asset->populate(
                 $_POST["Asset"],
                 $_POST['AssetCustomAttribute'],
                 $images
            );
            
            if ($asset->validate())
            {
                if (!$asset->save())
                {
                    throw new CHttpException(507,
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
            $asset->scenario = 'update';
        }

        $this->controller->render('update', array('asset'=>$asset));
    }
}
