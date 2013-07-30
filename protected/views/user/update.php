<?php
/**
 * Form for updating a registered user
 * @uses UserController $this
 * @uses UserModel $model
 */

?>

<h1>Update User <?php echo $model->id; ?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>