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
        <h1>Barbie's Playhouse</h1>
        <img src="http://inventory.lifecyclebuildingcenter.org/img/display-cabinet-md.jpg" alt="Mahogany Doors" /> 
    </div>
    <div class="product-meta">
        <p class="product-summary">Residential Corner Cabinets:  Solid hardwood with glass insets</p>
        <table class="product-attributes">
            <thead></thead>
            <tbody>
                <tr>
                    <th>Size</th>
                    <td>3' x 3' x 95 3/4"H.</td>
                </tr>
                <tr>
                    <th>Quantity Available</th>
                    <td>2</td>
                </tr>
                <tr>
                    <th>Color</th>
                    <td>White/Pink</td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>$225</td>
                </tr>
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
