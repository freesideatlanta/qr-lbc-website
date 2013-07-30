<?php
/**
 * Form for logging into the site
 * @uses UserController $this
 * @uses UserModel $model
 * @var CActiveForm $form
 */
?>


<h1>Log in</h1>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'loginForm',
        'enableAjaxValidation'=>false,
    ));

    echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',
                                    array('tabindex'=>'1')); ?>
    </div>

    <div class="row">
        <div>
        <?php
            echo $form->labelEx($model,'password',
                                array('class'=>'inline'));
        ?>
        <span>
        (<?php echo CHtml::link('Forgot?', '/user/forgot');?>)
        </span>
        
        </div>
        <?php echo $form->passwordField($model,'password',
            array('tabindex'=>'2')); ?>
    </div>
    
    <?php

    echo CHtml::link('Register an account', '/user/register',
                           array('class'=>'register button'));
                           
    echo CHtml::submitButton('Log in');
    
    ?>

<?php $this->endWidget(); ?>
</div>
