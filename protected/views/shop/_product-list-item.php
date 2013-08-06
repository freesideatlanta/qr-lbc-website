<?php
/**
 * @var $asset array - Asset JSON
 */

echo CHtml::image($asset['photos'][0], '', array(
        'class'=>'product-list-item-image',
    ));

echo CHtml::tag('h1', array(
        'class'=>'product-list-item-heading',
    ), $asset["name"]);
