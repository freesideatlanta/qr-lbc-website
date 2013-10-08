<?php

/**
 * Renders a single asset.
 *
 * @author Sage Gerard
 */

class ViewAction extends CAction
{
    /**
     * Renders single asset by ID
     *
     * @param string $id ID of asset to render as hex string
     * @return void
     */
    public function run($id)
    {
        if (!isset($id))
        {
            throw new CHttpException(400, "Asset not specified.");
        }

        $asset = QratitudeHelper::getAsset($id);

        $this->controller->render('view', array('asset'=>$asset));
    }
}
