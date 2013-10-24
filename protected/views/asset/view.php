<?php
/* @var $this AssetController */
/* @var $asset Asset Model to render*/

$this->breadcrumbs=array(
	'Asset'=>array('/asset'),
	'View',
);

$clientscript = Yii::app()->clientScript;
$clientscript->registerCssFile('http://fotorama.s3.amazonaws.com/4.4.6/fotorama.css');
$clientscript->registerCoreScript('jquery');
$clientscript->registerScriptFile('http://fotorama.s3.amazonaws.com/4.4.6/fotorama.js', CClientScript::POS_END);

?>

<div class="product">
    <div class="product-display">
        <?php
        if (!empty($asset->imageUrls))
        {
            // Build fotorama gallery
            $images = "";
            foreach ($asset->imageUrls as $url)
            {
                $images .= CHtml::image($url, '');
            }

            $html_options = array(
                'align'=>'center',
                'class'=>'fotorama'
            );

            echo CHtml::tag('div', $html_options, $images);
        }
        else
        {
            // Show default image
            $dummy_src = Yii::app()->params['default-asset-image'];
            echo CHtml::image($dummy_src, '',
                array('class'=>'product-image'));
        }
        ?>
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
           href="<?php echo $this->createUrl('asset/update',
               array('id'=>$asset->id));?>">Edit</a>
        <a class="button button-danger"
           href="<?php echo $this->createUrl('asset/delete',
               array('id'=>$asset->id)); ?>">Delete</a>
        <?php endif; ?>
    </div>
    </div>
</div>
