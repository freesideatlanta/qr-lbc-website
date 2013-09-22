<div class="banner">
 <img src="/images/grand-opening.jpg" alt="LBC Banner" class="banner-image">
 <div class="banner-caption-box">
 <h1 class="banner-caption">Shop LBC. Now Online.</h1>
 <h2 class="is-visible-desktop banner-subcaption">Turning waste into wealth + opportunity, while benefitting the community.</h2>
 </div>
</div>

<?php

// $assets = require(dirname(__FILE__).'/../../phplib/dummy.php');
$assets = QratitudeHelper::getAssetsByTags('featured');

$this->widget(
    'application.widgets.products.ProductsWidget',
    array(
        'heading'  => 'Featured Items',
        'css_class'=> 'featured',
        'assets'   => $assets,
        'display_grid'=>true
    )
);
