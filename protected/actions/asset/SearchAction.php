<?php

/**
 * Displays assets by tags. In the query string,
 * $t is a comma-delimited list of tags.
 *
 * @author Sage Gerard
 */

class SearchAction extends CAction
{
    /**
     * Asks the back end for assets by search string.
     * Search algorithm is implemented by QRatitude,
     *
     * @param string $q Query string
     * @return void
     */
    public function run($q)
    {
        $assets = QratitudeHelper::searchAssets($q);
        $this->controller->render('index', array(
            'assets'=>$assets
        ));
    }    
}
