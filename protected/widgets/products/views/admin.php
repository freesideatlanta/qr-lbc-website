<?php

// Always show buttons for now
$can_edit   = true;
$can_delete = true;

echo CHtml::tag('div',
    array(
        'class'=>"${css_class}-thumb",
    ), $a->imageUrls[0]
);

echo CHtml::tag('a',
    array(
        'class'=>"${css_class}-name",
        'href'=>"/asset/view/".$a->id
    ), $a->name
);


// Add edit button if user is authorized to edit
if ($can_edit)
{
    echo CHtml::tag('a',
        array(
            'class'=>"button button-action",
            'href'=>"/asset/edit/".$a->id,
        ), "Edit"
    );
}

// Add delete button if user is authorized to delete
if ($can_delete)
{
    echo CHtml::tag('a',
        array(
            'class'=>"button button-danger",
            'href'=>"/asset/delete/".$a->id,
        ), "Delete"
    );
}
