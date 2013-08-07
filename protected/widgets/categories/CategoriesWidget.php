<?php

class CategoriesWidget extends CWidget
{
    public function run()
    {
        $yii = Yii::app();

        $yii->clientScript->registerScript("CategoryWidgetBehavior","
            $('#category-expand').click(function() {
                var c = $('.categories');
                if (c.is(':visible'))
                {
                    c.addClass('is-hidden');
                    $(this).html('+');
                }
                else
                {
                    c.removeClass('is-hidden');
                    $(this).html('-');
                }
            }); 
            
        ", CClientScript::POS_READY);

        $data = Yii::app()->get('/category');

        $items = "";

        foreach ($data['categories'] as $c)
        {
            $a = CHtml::link($c, array(
                '/shop/tag',
                't'=>$c
             ));

            $items .= CHtml::tag('li',array(),$a);
        }

        $expander = CHtml::tag('span', array(
            'class'=>'expander',
            'id'=>'category-expand'
        ), "+");

        $heading = CHtml::tag('h2', array('class' =>'sidebar-widget-label'), "Categories ".$expander);
        $ul = CHtml::tag('ul',array('class'=>'categories is-hidden'),$items);

        echo CHtml::tag('div',array('class'=>'sidebar-widget is-bordered'),$heading.$ul);
    }
}
