<?php
/**
 * Form for searching through user models
 * @uses UserController $this
 * @uses UserModel $model
 * @var CActiveForm $form
 */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row">
        <?php
        echo $form->label($model,'id');
        echo $form->textField($model,'id',
                              array('size'=>10,'maxlength'=>10));
        ?>
    </div>

    <div class="row">
        <?php
        echo $form->label($model,'display_name');
        echo $form->textField($model,'display_name',
                              array('size'=>45,'maxlength'=>45));
        ?>
    </div>

    <div class="row">
        <?php
        echo $form->label($model,'email');
        echo $form->textField($model,'email',
                              array('size'=>60,'maxlength'=>64));
        ?>
    </div>

    <div class="row">
        <?php
        echo $form->label($model,'hash');
        echo $form->textField($model,'hash',
                              array('size'=>60,'maxlength'=>72));
        ?>
    </div>

    <div class="row">
        <?php
        echo $form->label($model,'date_joined');
        echo $form->textField($model,'date_joined');
        ?>
    </div>

    <div class="row">
        <?php
        echo $form->label($model,'verified');
        echo $form->textField($model,'verified');
        ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->