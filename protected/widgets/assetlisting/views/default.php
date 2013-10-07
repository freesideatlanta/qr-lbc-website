<?php
/**
 * Renders a single asset.
 * Exposes the following CSS classes prefixed
 * with {@link ProductsWidget::css_class}
 *
 * * -list-item-summary
 * * -list-item-meta
 * * -list-item-heading
 *
 * @uses Asset $asset Asset to render
 */


$image = CHtml::tag(
    'div',
    array(
        'class'=>$this->css_class.'-thumbnail',
        'style'=>'background-image: url('.$asset->imageUrls[0].');'
    ),
    ''
);

$heading = CHtml::tag(
    'h3',
    array(
        'class'=>$this->css_class.'-list-item-heading',
    ),
    $asset->name
);

// Generate link to view the asset on its own page.
// In this script, we are just rendering a simple
// listing of the asset that is part of a bigger set
// (like search results)
$view_url = '/asset/view/'.$asset->id;
echo CHtml::link($image, $view_url);

$meta = CHtml::link($heading, $view_url);

// Can we show the summary?
if ($this->view_vars['show_summary'])
{
    $s = $asset->summary;

    // truncate long summaries with ellipses
    if (strlen($s) > 40)
    {
        $s  = substr($s,  0, 40);
        $s .= '...';
    }

    $meta .= CHtml::tag(
        'p',
        array('class'=>$this->css_class.'-list-item-summary'),
        $s
    );
}

echo CHtml::tag(
    'div',
    array('class'=>$this->css_class.'-list-item-meta'),
    $meta
);

// True if user is authorized to see certain buttons.
// Always true for now.
$can_edit   = true;
$can_delete = true;

// Add edit button if user is authorized to edit
if ($can_edit)
{
    echo CHtml::tag(
        'a',
        array(
            'class'=>"button button-action",
            'href'=>"/asset/edit/".$asset->id,
        ),
        "Edit"
    );
}

// Add delete button if user is authorized to delete
if ($can_delete)
{
    echo CHtml::tag(
        'a',
        array(
            'class'=>"button button-danger",
            'href'=>"/asset/delete/".$asset->id,
        ),
        "Delete"
    );
}
