<?php
/**
 * Form for creating a user for the site
 * @uses UserController $this
 * @uses UserModel $model
 */
?>

<h1>Create User</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>