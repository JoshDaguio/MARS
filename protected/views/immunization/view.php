<?php
/* @var $this ImmunizationController */
/* @var $model Immunization */

$this->breadcrumbs=array(
	'Immunizations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Immunization', 'url'=>array('index')),
	array('label'=>'Create Immunization', 'url'=>array('create')),
	array('label'=>'Update Immunization', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Immunization', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Immunization', 'url'=>array('admin')),
);
?>

<h1>View Immunization #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'immunization',
		'description',
		'status_id',
	),
)); ?>
