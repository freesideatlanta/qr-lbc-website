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

        $asset = Yii::app()->get("/asset/$id");

        /*
        $json = json_encode(array(
            'id'=>'ss',
            'name'=>'asasd',
            'attributes'=>array('foo'=>'bar'),
            'photos'=>array('asas','asfdgdf')
        ));

        $post = Yii::app()->post("/asset", $json);

        header('Content-Type: text/plain');
        print_r($post);
         */


        $this->controller->render('item', array('asset'=>$asset));
    }
}
