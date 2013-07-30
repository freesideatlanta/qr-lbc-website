<?php
/**
 * CategoryAction class file.
 *
 * @author Sage Gerard <sage@isodev.us>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2013
 * @license http://www.yiiframework.com/license/
 */

/**
 * CategoryAction is ...
 *
 *
 * @author Sage Gerard <sage@isodev.us>
 * @version
 * @package
 * @since 1.0
 */


class CategoryAction extends CAction
{
    public function run($id)
    {
        $this->controller->layout = '//layouts/column2';

        // $assets = Yii::app()->get("/asset/?c=$id");

        // $this->controller->render('category', array('asset'=>$assets));
    }
}
