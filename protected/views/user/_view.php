<?php
/**
 * Displays a single user for CListView
 * @uses UserModel $data
 */

?>

<li class="view">
    <?php        
        $link = CHtml::link(CHtml::encode($data->id),
                            array('view', 'id'=>$data->id));
                            
        echo CHtml::tag('span', array('class'=>'big'), '# '.$link);
    ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('display_name')); ?>:</b>
    
    <?php echo ($data->display_name == null) ? "Not set" : CHtml::encode($data->display_name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
    <?php echo CHtml::encode($data->email); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('date_joined')); ?>:</b>
    <?php echo CHtml::encode($data->date_joined); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('verified')); ?>:</b>
    <?php echo ($data->verified) ? 'Yes' : 'No'; ?>
    <br />
</li>