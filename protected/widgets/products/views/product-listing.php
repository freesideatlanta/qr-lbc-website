<?php
/**
 * View for an array of assets.
 */

// holds HTML for assets
$items = "";

foreach ($assets as $a)
{
    // render single asset in a list item
    $item   = $this->render($this->view, array('asset'=>$a), true);
    $item   = CHtml::tag('li', array(), $item);

    $items .= $item;
}

// Output unordered list of assets
echo CHtml::tag(
    'ul',
    array(
        'class'=>$this->css_class.'-list',
    ),
    $items
);
