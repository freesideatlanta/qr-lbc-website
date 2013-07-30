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
    <img src="<?php echo $asset['photos'][0]; ?>" /> 
    </div>
    <div class="product-meta">
    <h1><?php echo $asset['attributes']['name']; ?></h1>
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
        <h3 class="">Store Hours</h3>
        <p>Tuesdays &amp; Fri: 10am-6pm, Sat: 10am-4pm (EST)</p>

        <a class="product-buy-button button"
           href="<?php echo $this->createUrl('shop/buy' /*, array('asset'=>$asset->id) */); ?>">Purchase</a>
        <a class="product-contact-button button"
           href="<?php echo $this->createUrl('site/contact'); ?>">Contact LBC</a>

    </div>
    </div>
</div>
