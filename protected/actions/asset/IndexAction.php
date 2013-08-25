<?php

class IndexAction extends CAction
{
    public function run()
    {
        // list all assets (paginated)
        // $assets = Yii::app()->get("/asset");
        $assets = require(dirname(__FILE__).'/../../phplib/dummy.php');
        $this->controller->render('index', array(
            'assets'=>$assets
        ));
    }    
}
