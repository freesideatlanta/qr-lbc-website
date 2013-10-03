<?php

/**
 * Displays assets by tags. In the query string,
 * $t is a comma-delimited list of tags.
 */

class SearchAction extends CAction
{
    public function run($q)
    {
        $assets = QratitudeHelper::searchAssets($q);
        $this->controller->render('index', array(
            'assets'=>$assets
        ));
    }    
}
