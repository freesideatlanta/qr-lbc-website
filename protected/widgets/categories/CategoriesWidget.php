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
            
            function getWidth()
            {
                var x = 0;
                if (self.innerHeight)
                {
                      x = self.innerWidth;
                }
                else if (document.documentElement &&
                         document.documentElement.clientHeight)
                {
                      x = document.documentElement.clientWidth;
                }
                else if (document.body)
                {
                      x = document.body.clientWidth;
                }
                return x;
            }

            // 970px is the defined max-width for tablets
            // in the theme. Anything more is considered
            // to be desktop.
            if (getWidth() > 970)
            {
                $('.categories').removeClass('is-hidden');
                $('#category-expand').html('-');
            }
                
        ", CClientScript::POS_READY);

        $data = Yii::app()->get('/categories');

        $items = "";

        foreach ($data['categories'] as $c)
        {
            $a = CHtml::link($c, array(
                '/asset/tag',
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
