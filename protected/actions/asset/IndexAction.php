<?php

class IndexAction extends CAction
{
    public function run()
    {
        // list all assets (paginated)
        $assets = QratitudeHelper::getAllAssets();
        $this->controller->render('index', array(
            'assets'=>$assets
        ));
    }    
}
