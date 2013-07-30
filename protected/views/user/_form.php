<?php
/**
 * Form for creating a user for the site
 * @uses UserController $this
 * @uses UserModel $model
 * @var CActiveForm $form
 */

?>

<div class="form">
<?php

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">
    Fields with <span class="required">*</span> are required.
    </p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php
        echo $form->labelEx($model,'display_name');
        echo $form->textField($model,'display_name',
                              array('size'=>45,'maxlength'=>45));
        echo $form->error($model,'display_name');
        ?>
    </div>

    <div class="row">
        <?php
        echo $form->labelEx($model,'email');
        
        echo $form->textField($model,'email',
                              array('size'=>60,'maxlength'=>64));
        
        echo $form->error($model,'email');
        ?>
    </div>

    <div class="row">
        <?php
        echo $form->labelEx($model,'verified');
        echo $form->textField($model,'verified');
        echo $form->error($model,'verified');
        ?>
    </div>

    <div class="row buttons">
      <?php
      echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');
      ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->