<?php

$items = "";
foreach ($assets as $a)
{
    $item = $this->renderPartial(
        '_product-list-item',
        array('asset'=>$a)
    );

    $items .= CHtml::tag('li', array(), $item);
}

echo CHtml::tag(
    'ul',
    array(
        'class'=>'product-listing',
    ),
    $items
);
