<?php
/**
 * Renders listing using {@link AssetListingWidget}
 */

/* @var $this AssetController */
/* @var $assets array */

$this->breadcrumbs=array(
	'Asset',
);

$this->widget(
    'application.widgets.assetlisting.AssetListingWidget',
    array(
        'heading'  => 'Products',
        'css_class'=> 'console',
        'assets'   => $assets,
    )
);
