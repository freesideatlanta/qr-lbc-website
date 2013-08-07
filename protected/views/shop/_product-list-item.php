<?php
/**
 * @var $asset array - Asset JSON
 */

echo CHtml::image($asset['photos'][0], '', array(
        'class'=>'product-list-thumbnail',
    ));

echo CHtml::tag('h3', array(
        'class'=>'product-list-item-heading',
    ), $asset["name"]);


$s = $asset["summary"];

if (strlen($s) > 40)
{
    $s  = substr($s,  0, 40);
    $s .= '...';
}

echo CHtml::tag('p', array(
        'class'=>'product-list-item-summary',
    ), $s);
