<?php
/* @var $this DoctorSchedController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Doctor Scheds',
);

$this->menu=array(
	array('label'=>'Create DoctorSched', 'url'=>array('create')),
	array('label'=>'Manage DoctorSched', 'url'=>array('admin')),
);
?>

<h1>Doctor Scheds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
