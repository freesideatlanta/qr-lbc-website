<?php
/* @var $this AssetController */
/* @var $asset Asset Model to render*/

$this->breadcrumbs=array(
	'Asset'=>array('/asset'),
	'View',
);
?>

<div class="product">
    <div class="product-display">
        <img src="<?php echo $asset->imageUrls[0]; ?>"
             class="product-image" />
    </div>
    <div class="product-meta">
    <h1 class="product-name"><?php echo $asset->name; ?></h1>
    <p class="product-summary"><?php echo $asset->summary; ?></p>
        <table class="product-attributes">
            <thead></thead>
            <tbody>
                <?php
                    foreach ($asset->custom as $a) {
                        $tr  = CHtml::tag('th', array(), $a->key);
                        $tr .= CHtml::tag('td', array(), $a->val);
                        echo CHtml::tag('tr', array(), $tr);
                    }

                ?>
            </tbody>
        </table>
    <div class="product-actions">
        <a class="button button-action"
           href="<?php echo $this->createUrl('shop/buy',
                 array('asset'=>$asset->id)); ?>">Buy</a>
        <a class="button button-neutral"
           href="<?php echo $this->createUrl('site/contact');?>">Contact</a>

        <a class="button button-danger"
           href="<?php echo $this->createUrl('asset/update',
                 array('id'=>$asset->id)); ?>">Edit</a>
    </div>
    </div>
</div>
