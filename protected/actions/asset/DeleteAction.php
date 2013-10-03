<?php

class DeleteAction extends CAction
{
    public function run($id)
    {
        QratitudeHelper::deleteAsset($id);
        $this->controller->redirect('/asset');
    }    
}
