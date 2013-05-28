<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="span3">
        <div class="sidebar">
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

    <form method="get" action="/shop/search">
        <input placeholder="Search" type="search" name="search" class="search" />
    </form>

    <div class="sidebar-widget-label">Categories</div>
	<ul class="inv-categories">
		<li class="disabled">Appliances</li>
		<li>Architectural Items</li>
		<li>Cabinets</li>
		<li class="disabled">Ceiling</li>
		<li>Doors</li>
		<li class="disabled">Electrical</li>
		<li>Flooring</li>
		<li class="disabled">Hardware</li>
		<li class="disabled">Life Safety</li>
		<li class="disabled">Lighting</li>
		<li>Lumber / Wood</li>
		<li>Office Furniture</li>
		<li class="disabled">Paint</li>
		<li>Plumbing</li>
	    <li>Storage</li>
		<li class="disabled">Window</li>
	</ul>
	
        </div><!-- sidebar -->
    </div>
    <div class="span9">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
</div>
<?php $this->endContent(); ?>
