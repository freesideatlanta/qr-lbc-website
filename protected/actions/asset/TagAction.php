<?php

/**
 * Displays assets by tags. In the query string,
 * $t is a comma-delimited list of tags.
 */

class TagAction extends CAction
{
    public function run($t)
    {
        $assets = QratitudeHelper::getAssetsByTags($t);
        $this->controller->render('index', array(
            'assets'=>$assets
        ));
    }    
}
