<?php
/* @var $this DoctorSchedController */
/* @var $model DoctorSched */

$this->breadcrumbs=array(
	'Doctor Scheds'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DoctorSched', 'url'=>array('index')),
	array('label'=>'Create DoctorSched', 'url'=>array('create')),
	array('label'=>'Update DoctorSched', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DoctorSched', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DoctorSched', 'url'=>array('admin')),
);
?>

<h1>View DoctorSched #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'account_id',
		'working_days',
		'start_time',
		'end_time',
	),
)); ?>
