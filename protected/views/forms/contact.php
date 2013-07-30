<?php
/**
 * Form for hiring !solate to do a job
 * @uses SiteController $this
 * @uses ContactFormModel $model
 * @var CActiveForm $form
 */

$this->pageTitle = 'Contact';
$this->pageDescription = "Get in touch with !solate.";

echo CHtml::tag('div',array('class'=>'form hire'),false,false);
$form = $this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>false,
));
echo $form->errorSummary($model);

?>

<div class="row">
<?php
$attribute = 'email';
echo $form->labelEx($model,$attribute);
echo $form->textField($model,$attribute);
echo $form->error($model,$attribute);
?>
</div>

<div class="row">
<?php
$attribute = 'message';
echo $form->labelEx($model,$attribute);
echo $form->textArea($model,$attribute, 
                     array('rows'=>'8'));
echo $form->error($model,$attribute);
?>
</div>

<?php
echo CHtml::submitButton('Send');
$this->endWidget();
echo CHtml::closeTag('div');
