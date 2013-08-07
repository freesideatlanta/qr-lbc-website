<?php
/**
 * @author Sage Gerard <sage@isodev.us>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2013 Sage Gerard
 */

/**
 * IndexAction provides an intoductory interface to browse wares.
 *
 *
 * @author Sage Gerard <sage@isodev.us>
 * @version
 * @package
 * @since 1.0
 */


class IndexAction extends CAction
{

    public function run()
    {
        // place the action logic here
        $this->controller->redirect('/site/index');
    }
}
