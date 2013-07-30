<?php
/**
 * Displays a single user on the site
 * @uses UserController $this
 * @uses UserModel $model
 */
 
if (Yii::app()->user->checkAccess('admin'))
{
    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions'=>array(
            'class'=>'subnav',
            ),
        'lastItemCssClass'=>'last',
        'items'=>array(
            array(
                'label'=>'All users',
                'url'=>array('admin'),
            ),
            array(
                'label'=>'Edit',
                'url'=>array('update', 'id'=>$model->id),
                ),            
            array(
                'label'=>'Delete',
                'url'=>'#',
                'linkOptions'=>array(
                    'submit'=>array('delete','id'=>$model->id),
                    'confirm'=>'You cannot undo this. You sure?'
                    ),
                ),
            ),
        ));
}
?>

<h1>View User #<?php echo $model->id; ?></h1>

<?php
$cssFile = Yii::app()->theme->baseUrl.'/css/widgets/CDetailView.css';
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'display_name',
        'email',
        'date_joined',
        'verified',
    ),
    'cssFile'=>$cssFile
));