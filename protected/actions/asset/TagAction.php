<?php

/**
 * Displays assets by tags. In the query string,
 * $t is a comma-delimited list of tags.
 *
 * @author Sage Gerard
 */

class TagAction extends CAction
{
    /**
     * Renders assets retrieved from the back end by tags.
     *
     * @param string $t Comma-delimited list of tags for desired assets.
     * @return void
     */
    public function run($t)
    {
        $assets = QratitudeHelper::getAssetsByTags($t);
        $this->controller->render('index', array(
            'assets'=>$assets
        ));
    }    
}
