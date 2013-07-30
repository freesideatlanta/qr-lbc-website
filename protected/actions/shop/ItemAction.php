<?php
/**
 * ItemAction class file.
 *
 * @author Sage Gerard <sage@isodev.us>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2013
 * @license http://www.yiiframework.com/license/
 */

/**
 * ItemAction is ...
 *
 *
 * @author Sage Gerard <sage@isodev.us>
 * @version
 * @package
 * @since 1.0
 */


class ItemAction extends CAction
{
    public function run($id)
    {
        $this->controller->layout = '//layouts/column2';

        $rest = new RestCurlClient();
        
        $url = Yii::app()->params['apiPrefix'];

        $asset = json_decode($rest->get($url."/asset/$id"), true);

  //      header('Content-Type: text/plain');
//        var_dump($asset);

        $this->controller->render('item', array('asset'=>$asset));
    }
}
