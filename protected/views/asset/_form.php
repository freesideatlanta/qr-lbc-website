<?php

/**
 * This is the form used to create and edit assets.
 * @uses Asset $asset
 */

$yii          = Yii::app();
$max_files    = 8;
$aid          = $this->getAction()->getId();
$isUpdating   = $aid === "update";

$action_route  = $isUpdating ? 'asset/update' : 'asset/create';
$action_params = $isUpdating ? array('id'=>$asset->id) : array();

$form = $this->beginWidget('CActiveForm', array(
    'action'=>$yii->createUrl(
        $action_route,
        $action_params
    ),
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'errorMessageCssClass'=>'is-wrong',
    'focus'=>array($asset,'name'),
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data',
        'class'=>'form-asset'
    ),
));

echo $yii->dumpFlashHtml();

echo CHtml::tag('h1', array(), 'Identification');



// ASSET NAME
////////////////////////////////////////////////////////

$attr = "name";
$f  = $form->labelEx($asset, $attr);
$f .= $form->textField($asset, $attr);
$f .= $form->error($asset, $attr);
echo CHtml::tag('div', array('class'=>'form-row'), $f);



// ASSET TAGS
////////////////////////////////////////////////////////

$attr = "tags";
$f  = $form->labelEx($asset, $attr);
$f .= CHtml::tag(
    'p',
    array(
        'class'=>'form-sublabel'
    ),
    "Enter a comma-separated list of tags that describe ".
    "this item to keep things organized. ".
    "Some useful tags might be 'featured' for featured products, ".
    "'red' for red products, and so on."
);

$f .= $form->textField($asset, $attr);
$f .= $form->error($asset, $attr);
echo CHtml::tag('div', array('class'=>'form-row'), $f);



// ASSET SUMMARY
////////////////////////////////////////////////////////

$attr = "summary";
$f  = $form->labelEx($asset, $attr);

$f .= CHtml::tag('p', array('class'=>'form-sublabel'),
                 "Breifly describe the object");

$f .= $form->textArea($asset, $attr,
                      array('class'=>'summary-area'));

$f .= $form->error($asset, $attr);
echo CHtml::tag('div', array('class'=>'form-row'), $f);



// IMAGE UPLOAD FORM
////////////////////////////////////////////////////////

$f  = CHtml::tag('h1', array(), 'Photos');
$f .= CHtml::tag(
    'p',
    array(
        'class'=>'form-sublabel'
    ),
    "You can upload up to $max_files photos."
);

$f .= $this->widget('CMultiFileUpload', array(
    'name'        => 'images',
    'accept'      => 'jpeg|jpg|gif|png',
    'max'         => $max_files,
    'duplicate'   => 'Duplicate file detected!',
    'denied'      => 'Invalid file type',
    'value'       => 'bar',
    'htmlOptions' => array(
                        'value'=>'foo'
                     )
), true);

echo CHtml::tag('div', array('class'=>'form-row'), $f);



// CUSTOM ATTRIBUTE TABLE
////////////////////////////////////////////////////////

// Render table of fields to let user set custom attributes ?>

<div class="form-row">
<h1>Attributes <a id="asset-form-add-button">+</a></h1>

<table>
    <thead>
        <th>Name</th>
        <th>Value</th>
    </thead>
    <tbody id="asset-form-attr-rows">
    <?php
        foreach ($asset->custom as $i=>$a)
        {
            // Input fields for attribute name and value
            $input_key = CHtml::activeTextField($a, "[$i]key");
            $input_val = CHtml::activeTextField($a, "[$i]val");

            // This link deletes the row it appears in
            $delete_attr = CHtml::tag('a', array(
                'class'=>'delete-attr button button-danger'),
            'x');

            // Generate row content
            $tds  = CHtml::tag('td', array(), $input_key);
            $tds .= CHtml::tag('td', array(), $input_val);
            $tds .= CHtml::tag('td', array(), $delete_attr);
            echo CHtml::tag('tr', array(), $tds);
        }
    ?>
    </tbody>
</table>
</div>

<?php


$f = CHtml::submitButton(
    $isUpdating ? "Save Changes" : "Create Asset",
    array(
        'class'=>'button-action'
    )
);

echo CHtml::tag('div', array('class'=>'form-row'), $f);

$this->endWidget();
