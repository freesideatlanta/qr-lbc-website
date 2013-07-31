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

    <?php $this->widget('application.widgets.categories.CategoriesWidget'); ?>
</div>

<div class="l-content">
    <?php echo $content; ?>
</div>

<?php $this->endContent(); ?>
