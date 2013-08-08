<?php
/**
 * @var $asset array - Asset JSON
 */

$image = CHtml::tag('div', array(
    'class'=>$this->css_class.'-thumbnail',
    'style'=>'background-image: url('.$asset['photos'][0].');'
    ), '');

$heading = CHtml::tag('h3', array(
        'class'=>$this->css_class.'-list-item-heading',
    ), $asset["name"]);

echo CHtml::link($image, $asset['url']);
$heading = CHtml::link($heading, $asset['url']);

if ($this->show_summary)
{
    $s = $asset["summary"];

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
