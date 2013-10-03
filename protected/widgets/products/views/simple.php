<?php
/**
 * @var $asset Asset Asset to render
 */

$image = CHtml::tag('div', array(
    'class'=>$this->css_class.'-thumbnail',
    'style'=>'background-image: url('.$asset->imageUrls[0].');'
    ), '');

$heading = CHtml::tag('h3', array(
        'class'=>$this->css_class.'-list-item-heading',
    ), $asset->name);

$view_url = '/asset/view/'.$asset->id;

echo CHtml::link($image, $view_url);
$heading = CHtml::link($heading, $view_url);

if ($this->view_vars['show_summary'])
{
    $s = $asset->summary;

    // truncate long summaries with ellipses
    if (strlen($s) > 40)
    {
        $s  = substr($s,  0, 40);
        $s .= '...';
    }

    $s = CHtml::tag('p', array(
            'class'=>$this->css_class.'-list-item-summary',
        ), $s);

    echo CHtml::tag('div', array(
        'class'=>$this->css_class.'-list-item-meta'
    ), $heading.$s);
}
else
{
    echo CHtml::tag('div', array(
        'class'=>$this->css_class.'-list-item-meta'
    ), $heading);
}
