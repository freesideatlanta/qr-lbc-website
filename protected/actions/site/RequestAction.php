<?php
/**
 * RequestAction class file.
 *
 * @author Sage Gerard <sage@isodev.us>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2013 Freeside Atlanta
 * @license http://www.yiiframework.com/license/
 */

/**
 * RequestAction is ...
 *
 *
 * @author Sage Gerard <sage@isodev.us>
 * @version
 * @package
 * @since 1.0
 */


class RequestAction extends CAction
{

    public function run()
    {
        // place the action logic here
        $this->controller->redirect('/site/contact');
    }
}
