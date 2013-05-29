<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form TbActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'alerts'=>array('contact'),
    )); ?>

<?php else: ?>

<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'login-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->labelEx($model,'username'); ?>
    <?php echo $form->textField($model,'username'); ?>
    <?php echo $form->error($model,'username'); ?>

    <?php echo $form->labelEx($model,'password'); ?>
    <?php echo $form->passwordField($model,'password'); ?>
    <?php echo $form->error($model,'password'); ?>

    <?php echo $form->checkBox($model,'rememberMe'); ?>
    <?php echo $form->label($model,'rememberMe'); ?>
    <?php echo $form->error($model,'rememberMe'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton',array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Submit',
        )); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->

<?php endif; ?>
