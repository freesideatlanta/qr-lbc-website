<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span3">
    <div class="l-sidebar">
    <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>'Operations',
        ));
        $this->widget('bootstrap.widgets.TbMenu', array(
            'items'=>$this->menu,
            'htmlOptions'=>array('class'=>'operations'),
        ));
        $this->endWidget();
    ?>

<form method="get" action="/shop/search" class="sidebar-widget">
    <input placeholder="Search" type="search" name="search" class="sidebar-widget-search" />
</form>

<div class="sidebar-widget is-bordered">
    <div class="sidebar-widget-label">Categories</div>
    <ul class="inv-categories">
        <li class="is-disabled">Appliances</li>
        <li>Architectural Items</li>
        <li>Cabinets</li>
        <li class="is-disabled">Ceiling</li>
        <li>Doors</li>
        <li class="is-disabled">Electrical</li>
        <li>Flooring</li>
        <li class="is-disabled">Hardware</li>
        <li class="is-disabled">Life Safety</li>
        <li class="is-disabled">Lighting</li>
        <li>Lumber / Wood</li>
        <li>Office Furniture</li>
        <li class="is-disabled">Paint</li>
        <li>Plumbing</li>
        <li>Storage</li>
        <li class="is-disabled">Window</li>
    </ul>
</div>

    </div><!-- sidebar -->
</div>
<div class="span9">
    <?php echo $content; ?>
</div>
<?php $this->endContent(); ?>
