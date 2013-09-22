<?php
/**
 * Renders asset listing.
 */

/* @var $this AssetController */
/* @var $assets array */

$this->breadcrumbs=array(
	'Asset',
);

$this->widget(
    'application.widgets.products.ProductsWidget',
    array(
        'heading'  => 'Products',
        'css_class'=> 'console',
        'assets'   => $assets,
    )
);
