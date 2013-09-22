<?php

/**
 * Renders a single asset.
 */

class ViewAction extends CAction
{
    public function run($id)
    {
        if (!isset($id))
        {
            // throw new CHttpException(400, "Specify an id for asset.");
        }

        $asset = QratitudeHelper::getAsset($id);

        $this->controller->render('view', array('asset'=>$asset));
    }
}
