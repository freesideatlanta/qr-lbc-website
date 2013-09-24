<?php
/**
 * Publicly accessible form for registering a new user
 * @uses UserController $this
 * @uses UserModel $model
 * @var CActiveForm $form
 */

?>

<h1>Register</h1>
<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'registerForm',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'focus'=>array($model,'email'),
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="form-row">
    <?php echo $form->labelEx($model,'username'); ?>
    <?php echo $form->textField($model,'username'); ?>
    <?php echo $form->error($model,'username'); ?>
</div>
<div class="form-row">
    <?php echo $form->labelEx($model,'password'); ?>
    <?php echo $form->passwordField($model,'password'); ?>
    <?php echo $form->error($model,'password'); ?>
</div>
<div class="form-row">
    <?php echo $form->labelEx($model,'password_confirm'); ?>
    <?php echo $form->passwordField($model,'password_confirm'); ?>
    <?php echo $form->error($model,'password_confirm'); ?>
</div>

<div class="form-row">
    <?php echo CHtml::submitButton('Register'); ?>
</div>

<?php $this->endWidget(); ?>
</div>
