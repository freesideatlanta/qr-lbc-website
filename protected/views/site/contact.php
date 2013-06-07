<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form TbActiveForm */

$this->layout = '//layouts/column1';

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>

<h1>Contact Us</h1>

<ul>
<li>Adam Deck, Director of Operations:
 <a href="mailto:adam@lifecyclebuildingcenter.org">adam@lifecyclebuildingcenter.org</a>
- 404.997.3873</li>
<li>Shannon Goodman, Executive Director:
<a href="mailto:shannon@lifecyclebuildingcenter.org">shannon@lifecyclebuildingcenter.org</a>
- 678.592.0417</li>
</ul>

<p>If you have business inquiries or other questions,
please fill out the following form to contact us.
Thank you.</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="form-actions">
    <input type="submit" value="Send" />
</div>

<?php $this->endWidget(); ?>
</div>
