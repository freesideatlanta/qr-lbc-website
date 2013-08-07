<?php

$this->layout = '//layouts/column2';

$this->widget(
    'application.widgets.products.ProductsWidget',
    array(
        'heading'  => 'Available Items',
        'css_class'=> 'product',
        'assets'   => require(dirname(__FILE__).'/../../phplib/dummy.php'),
        'show_summary' => true
    )
);
