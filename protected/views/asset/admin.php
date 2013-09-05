<?php
/* @var $this AssetController */
/* @var $assets array */

$this->breadcrumbs=array(
	'Asset',
);

$css_class = "asset-crud";

$trows  = "";

// Generate table heading
$headings = array(
    'Photo',
    'Name',
    'Edit',
    'Delete'
);

$thead = '<thead><tr><th>'.
         implode('</th><th>', $headings).
         '</th></tr></thead>';

// Place asset info in table rows
foreach ($assets as $a)
{
    $tr = "";

    $thumb = CHtml::tag('div',
        array(
            'class'=>"${css_class}-thumb",
            'style'=>"background-image: url('".$a['photos'][0]."'); width: 100px; height: 40px;",
        ),
        ''
    );

    $name = CHtml::tag('a',
        array(
            'class'=>"${css_class}-name",
            'href'=>"/asset/view/".$a['id']
        ), $a['name']
    );

    $edit_button = CHtml::tag('a',
        array(
            'class'=>"button button-action",
            'href'=>"/asset/update/".$a['id'],
        ), "Edit"
    );
    
    $delete_button = CHtml::tag('a',
        array(
            'class'=>"button button-danger",
            'href'=>"/asset/delete/".$a['id'],
        ), "Delete"
    );

    $tr .= CHtml::tag('td', array(), $thumb);
    $tr .= CHtml::tag('td', array(), $name);
    $tr .= CHtml::tag('td', array(), $edit_button);
    $tr .= CHtml::tag('td', array(), $delete_button);

    $trows .= CHtml::tag('tr', array(), $tr);
}


$tbody = CHtml::tag('tbody', array(), $trows);
$table = CHtml::tag('table', array(
        'class'=>'admin-table admin-table-assets'
    ), $thead.$tbody);

echo $table;
