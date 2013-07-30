<?php
/* @var $this ShopController
 * @var $asset Asset
 * */

$this->breadcrumbs=array(
	'Shop'=>array('/shop'),
	'Item',
);


?>

<div class="product">
    <div class="product-display">
    <img src="<?php echo $asset['photos'][0]; ?>" class="product-image" /> 
    </div>
    <div class="product-meta">
    <h1 class="product-name"><?php echo $asset['name']; ?></h1>
        <p class="product-summary">Residential Corner Cabinets:  Solid hardwood with glass insets</p>
        <table class="product-attributes">
            <thead></thead>
            <tbody>
                <?php
                    $attrs = $asset['attributes'];
                    foreach ($attrs as $k=>$v) {
                        $tr  = CHtml::tag('th', array(), $k);
                        $tr .= CHtml::tag('td', array(), $v);
                        echo CHtml::tag('tr', array(), $tr);
                    }

                ?>
            </tbody>
        </table>
    <div class="product-actions">
        <a class="product-buy-button"
           href="<?php echo $this->createUrl('shop/buy' /*, array('asset'=>$asset->id) */); ?>">Purchase</a>
        <a class="product-contact-button"
           href="<?php echo $this->createUrl('site/contact'); ?>">Contact LBC</a>

    </div>
    </div>
</div>
