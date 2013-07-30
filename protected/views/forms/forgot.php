<?php
/**
 * Form for recovering a user's password
 * @uses UserController $this
 * @uses UserModel $model
 * @var CActiveForm $form
 */

?>

<h1>Forgot Password</h1>
<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'forgotForm',
    'focus'=>array($model,'email'),
)); ?>

<div class="row">
    <?php
    echo $form->labelEx($model,'email');
    echo $form->textField($model,'email');
    echo $form->error($model,'email');
    ?>
</div>

<?php
echo CHtml::submitButton('Send Reset Instructions');
$this->endWidget();
?>
</div>
