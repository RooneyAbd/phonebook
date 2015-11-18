<?php
/* @var $this CardController */
/* @var $model Card */

$this->breadcrumbs=array(
	'Cards'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Card', 'url'=>array('index')),
	array('label'=>'Create Card', 'url'=>array('create')),
	array('label'=>'Update Card', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Card', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Card', 'url'=>array('admin')),
);
?>

<h1>View Card <?php echo $model->name; echo' '; echo $model->last_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
        'fathers_name',
		'last_name',
		array(
		'name'=>'office',
		'value'=>isset($model->office)?CHtml::encode($model->office0->of_name):"unknown"
		),
		array(
		'name'=>'department',
		'value'=>isset($model->department)?CHtml::encode($model->department0->dep_name):"unknown"
		),
		'phone',
		'other',
	),
)); ?>
