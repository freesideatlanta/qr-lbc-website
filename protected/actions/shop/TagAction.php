<?php
/**
 * @author Sage Gerard <sage@isodev.us>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2013 Sage Gerard
 */

/**
 * TagAction lists assets by tag
 *
 *
 * @author Sage Gerard <sage@isodev.us>
 * @version
 * @package
 * @since 1.0
 */


class TagAction extends CAction
{

    public function run($t)
    {
        if (empty($t))
        {
            throw new CHttpException(400, "At least one tag is needed to find products!");
        }

        $q = 't='.implode('&t=',explode($t, '+'));

        // GET /assets?$q

        $assets = require(dirname(__FILE__).'/../../phplib/dummy.php');

        $this->controller->render('product-listing', array(
            'assets'=>$assets
        ));
    }
}
