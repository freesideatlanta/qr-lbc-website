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
        if (is_null($id) || $id < 0 || $id > 4)
        {
            echo "<p>Invalid request for the purposes of this demo! Use IDs 0 through 4 only, please.</p>";
            Yii::app()->end();
        }

        $this->controller->layout = '//layouts/column2';

        // $asset = Yii::app()->get("/asset/$id");

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

        $assets = require(dirname(__FILE__).'/../../phplib/dummy.php');


        $this->controller->render('item', array('asset'=>$assets[$id]));
    }
}
