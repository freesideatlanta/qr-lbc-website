<?php
/**
 * Lists users
 * @uses UserController $this
 * @uses CActiveDataProvider $dataProvider Contains list of UserModel objects to be listed.
 */

$this->menu=array(
    array('label'=>'Create User', 'url'=>array('create')),
    array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Users</h1>
<ul class="models">
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>
</ul>