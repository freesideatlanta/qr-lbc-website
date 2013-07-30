<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="l-sidebar">

    <form method="get" action="/shop/search" class="sidebar-widget">
        <input
            placeholder="Search"
            type="search"
            name="search"
            class="sidebar-widget-search" />
    </form>

    <div class="sidebar-widget is-bordered">
        <div class="sidebar-widget-label">Categories</div>
        <ul class="inv-categories">
        <?php
            $res = Yii::app()->get('/category');

            foreach ($res['categories'] as $c)
            {
                $a = CHtml::link($c, array(
                    '/shop',
                    'category'=>$c
                 ));

                echo CHtml::tag('li',array(),$a);
            }
        
        ?>
        </ul>
    </div>
</div>
<div class="l-content">
    <?php echo $content; ?>
</div>

<?php $this->endContent(); ?>
