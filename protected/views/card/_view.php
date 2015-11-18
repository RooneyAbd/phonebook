<?php
/* @var $this CardController */
/* @var $data Card */
?>

<div class="view">



	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)) ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('fathers_name')); ?>:</b>
    <?php echo CHtml::encode($data->fathers_name); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
	<?php echo CHtml::encode($data->last_name); ?>
	<br />



	<b><?php echo CHtml::encode($data->getAttributeLabel('office')); ?>:</b>
	<?php echo CHtml::encode($data->office0->of_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('department')); ?>:</b>
	<?php echo CHtml::encode($data->department0->dep_name); ?>
	
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('other')); ?>:</b>
    <?php echo CHtml::encode($data->other); ?>
    <br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('other')); ?>:</b>
	<?php echo CHtml::encode($data->other); ?>
	<br />

	*/ ?>

</div>