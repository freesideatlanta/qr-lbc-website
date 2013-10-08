<?php

/**
 * Shows user profile
 *
 * @author Sage Gerard
 */
class ViewUserAction extends CAction
{
    /**
     * Renders a view of a user profile
     *
     * @param string $id ID of user on back end
     */
    public function run($id)
    {        
        $this->controller->render('view',array(
            'model'=>$this->controller->loadModel($id),
        ));
    }
}
