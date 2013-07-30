<?php

/**
 * Form for resetting a user's password
 * @uses UserController $this
 * @uses UserModel $model
 * @var CActiveForm $form
 */

?>

<h1>Reset Password</h1>
<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'resetForm',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'focus'=>array($model,'email'),
)); ?>

<?php echo $form->errorSummary($model); ?>

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

<?php echo CHtml::submitButton('Reset Password'); ?>

<?php $this->endWidget(); ?>
</div>