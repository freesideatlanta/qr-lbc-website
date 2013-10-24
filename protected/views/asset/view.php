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
        <img src="<?php echo isset($asset->imageUrls[0]) ?
                        $asset->imageUrls[0] :
                        Yii::app()->params['default-asset-image']; ?>"
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
        <a class="button button-good"
           href="<?php echo $this->createUrl('site/contact',
               array('asset'=>$asset->id)); ?>">Buy</a>

        <?php if (!Yii::app()->user->isGuest) : ?>
        <a class="button button-action"
           href="<?php echo $this->createUrl('asset/update');?>">Edit</a>
        <a class="button button-danger"
           href="<?php echo $this->createUrl('asset/delete',
               array('id'=>$asset->id)); ?>">Delete</a>
        <?php endif; ?>
    </div>
    </div>
</div>
