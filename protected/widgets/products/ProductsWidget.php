<?php

/**
 * Renders an array of assets.
 */

class ProductsWidget extends CWidget
{
    public $assets         = array();
    public $heading        = "Products";
    public $empty_message  = "There are no products to show.";
    public $css_class      = "css-class";
    public $view           = 'product-listing';

    public function run()
    {
        $yii = Yii::app();

        $html = CHtml::tag('h1', array(
            'class'=>$this->css_class.'-heading'),
            $this->heading);

        if (empty($this->assets))
        {
            $html .= CHtml::tag(
                'p',
                array('class'=>$this->css_class.'-empty-message'),
                $this->empty_message
            );
        }
        else
        {
            $html .= $this->render(
                $this->view,
                array('assets'=>$this->assets),
                true
            );
        }

        $html = CHtml::tag('div',
            array('class'=>$this->css_class),
            $html);

        echo $html;
    }
}
