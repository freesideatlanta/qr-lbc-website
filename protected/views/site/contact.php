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

<p>The Lifecycle Building Center warehouse is located at <a href="http://goo.gl/maps/w8vMw">1116 Murphy Avenue SW, Atlanta, GA 30310</a></p>

<p>Please direct all mail correspondence to: P.O. Box 7661, Atlanta, GA 30357</p>

<p>If you have business inquiries or other questions,
please fill out the following form to contact us.
Thank you.</p>

<div class="form contact-form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'errorMessageCssClass'=>'is-wrong',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<p class="note">Fields with <span class="is-required">*</span> are required.</p>

<?php
echo $form->errorSummary($model);

$attr = 'name';
echo $form->labelEx($model, $attr);
echo $form->textField($model, $attr);
echo $form->error($model, $attr);

$attr = 'email';
echo $form->labelEx($model, $attr);
echo $form->textField($model, $attr);
echo $form->error($model, $attr);

$attr = 'subject';
echo $form->labelEx($model, $attr);
echo $form->textField($model, $attr);
echo $form->error($model, $attr);

$attr = 'body';
echo $form->labelEx($model, $attr);
echo $form->textArea($model, $attr);
echo $form->error($model, $attr);

echo CHtml::tag('p',array(),"Please type the code below to prove you are human.");

$attr = 'verifyCode';
$this->widget('CCaptcha', array(
            'imageOptions'=>array(
                'class'=>'captcha-image',
            ),
            'buttonOptions'=>array(
                'class'=>'captcha-button',
            ),
        ));

echo $form->labelEx($model, $attr);
echo $form->textField($model, $attr);
echo $form->error($model, $attr);

?>

<div class="form-actions">
    <input type="submit" value="Send" />
</div>

<?php $this->endWidget(); ?>
</div>
