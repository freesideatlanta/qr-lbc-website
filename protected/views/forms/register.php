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

<div class="row">
    <?php echo $form->labelEx($model,'email'); ?>
    <?php echo $form->textField($model,'email'); ?>
    <?php echo $form->error($model,'email'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'password'); ?>
    <?php echo $form->passwordField($model,'password'); ?>
    <?php echo $form->error($model,'password'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'password_confirm'); ?>
    <?php echo $form->passwordField($model,'password_confirm'); ?>
    <?php echo $form->error($model,'password_confirm'); ?>
</div>

<?php echo CHtml::submitButton('Register'); ?>

<?php $this->endWidget(); ?>
</div>
