<?php

$this->layout = '//layouts/column2';

$items = "";
foreach ($assets as $a)
{
    $item = $this->renderPartial(
        '_product-list-item',
        array('asset'=>$a),
        true
    );

    $items .= CHtml::tag('li', array(), $item);
}

echo CHtml::tag(
    'ul',
    array(
        'class'=>'product-list',
    ),
    $items
);
