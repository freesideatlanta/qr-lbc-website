<?php

class FeaturedWidget extends CWidget
{
    public function run()
    {
        $yii = Yii::app();

        $yii->clientScript->registerScript("grid-spacer", "

            function recalc()
            {
                var li = $('.featured-list > li');
                var parent = $('.featured-list').width();
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

        // $data = Yii::app()->get('/asset/?t=featured');

        $data = array(
            array(
                'name'=>'Swiffer',
                'photos'=>array('http://www.myfacewhen.net/uploads/218-funny-face.jpg'),
            ),
            array(
                'name'=>'Swapper',
                'photos'=>array('http://www.myfacewhen.net/uploads/218-funny-face.jpg'),
            ),
            array(
                'name'=>'Schwapper',
                'photos'=>array('http://www.myfacewhen.net/uploads/218-funny-face.jpg'),
            ),
            array(
                'name'=>'Swiffer',
                'photos'=>array('http://www.myfacewhen.net/uploads/218-funny-face.jpg'),
            ),
            array(
                'name'=>'Swapper',
                'photos'=>array('http://www.myfacewhen.net/uploads/218-funny-face.jpg'),
            ),
            array(
                'name'=>'Schwapper',
                'photos'=>array('http://www.myfacewhen.net/uploads/218-funny-face.jpg'),
            ),
            array(
                'name'=>'Swiffer',
                'photos'=>array('http://www.myfacewhen.net/uploads/218-funny-face.jpg'),
            ),
            array(
                'name'=>'Swapper',
                'photos'=>array('http://www.myfacewhen.net/uploads/218-funny-face.jpg'),
            ),
            array(
                'name'=>'Schwapper',
                'photos'=>array('http://www.myfacewhen.net/uploads/218-funny-face.jpg'),
            ),
        );

        $items = "";

        foreach ($data as $asset)
        {
            $item = $this->render('featured-item',
                array('asset'=>$asset), true);

            $items .= CHtml::tag('li',array(),$item);
        }

        $heading = CHtml::tag('h1', array( 'class' =>'featured-heading'), "Featured Items");
        $ul = CHtml::tag('ul',array('class'=>'featured-list'),$items);

        echo CHtml::tag('div',array('class'=>'featured'),$heading.$ul);
    }
}
