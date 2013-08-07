<?php

$items = "";
foreach ($assets as $a)
{
    $item   = $this->render('product', array('asset'=>$a), true);
    $item   = CHtml::tag('li', array(), $item);
    $items .= $item;
}

echo CHtml::tag(
    'ul',
    array(
        'class'=>$this->css_class.'-list',
    ),
    $items
);
