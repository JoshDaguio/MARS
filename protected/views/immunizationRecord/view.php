<?php
/* @var $this ImmunizationRecordController */
/* @var $model ImmunizationRecord */

$this->breadcrumbs=array(
	'Immunization Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ImmunizationRecord', 'url'=>array('index')),
	array('label'=>'Create ImmunizationRecord', 'url'=>array('create')),
	array('label'=>'Update ImmunizationRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ImmunizationRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ImmunizationRecord', 'url'=>array('admin')),
);
?>

<h1>View ImmunizationRecord #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'account_id',
		'immunization_id',
		'date',
		'remarks',
		'status_id',
	),
)); ?>
