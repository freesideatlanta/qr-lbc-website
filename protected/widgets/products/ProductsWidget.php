<?php

class ProductsWidget extends CWidget
{
    public $assets             = array();
    public $heading            = "Products";
    public $css_class          = "css-class";
    public $show_summary       = false;
    public $display_grid       = false;

    public function run()
    {
        $yii = Yii::app();

        if ($this->display_grid)
        {
            $yii->clientScript->registerScript("grid-spacer", "
                function recalc()
                {
                    var li = $('.".$this->css_class."-list > li');
                    var parent = $('.".$this->css_class."-list').width();
                    var box = li.width();

                    var columns = Math.floor(parent/box);

                    var space = (parent - (box * columns)) / columns;

                    li.css('margin-left', space/2);
                    li.css('margin-right', space/2);
                }

                recalc();

                $(window).resize(function() {
                     recalc(); 
                });
            ", CClientScript::POS_READY);
        }

        // $data = Yii::app()->get('/asset/?t=featured');

        $html = "";

        $html .= CHtml::tag('h1', array(
            'class'=>$this->css_class.'-heading'),
            $this->heading);

        $html .= $this->render('product-listing',
            array('assets'=>$this->assets), true);

        echo CHtml::tag('div',
            array('class'=>$this->css_class),
            $html);
    }
}
