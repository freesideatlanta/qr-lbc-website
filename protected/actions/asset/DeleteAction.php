<?php

/**
 * Deletes an asset from the inventory.
 *
 * @author Sage Gerard
 */
class DeleteAction extends CAction
{
    /**
     * Tells the back end to remove an asset by id.
     *
     * @param string $id ID of the asset, as hex string
     * @return void
     */
    public function run($id)
    {
        QratitudeHelper::deleteAsset($id);
        $this->controller->redirect('/asset');
    }    
}
