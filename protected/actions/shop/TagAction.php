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
        //

        $assets = array(
            array(
                'name'=>'Orange',
                'photos'=>array('http://dummyimage.com/250/ff8000/?text=%20'),
            ),
            array(
                'name'=>'Red',
                'photos'=>array('http://dummyimage.com/250/ff0000/?text=%20'),
            ),
            array(
                'name'=>'Green',
                'photos'=>array('http://dummyimage.com/250/00ff00/?text=%20'),
            ),
            array(
                'name'=>'Blue',
                'photos'=>array('http://dummyimage.com/250/0000ff/?text=%20'),
            ),
            array(
                'name'=>'Yellow',
                'photos'=>array('http://dummyimage.com/250/ffff00/?text=%20'),
            ),
            array(
                'name'=>'Purple',
                'photos'=>array('http://dummyimage.com/250/8000ff/?text=%20'),
            ),
        );

        $this->controller->render('product-listing', array(
            'assets'=>$assets
        ));
    }
}
