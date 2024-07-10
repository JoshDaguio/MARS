<?php
/* @var $this PrescriptionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Prescriptions',
);

$this->menu=array(
	array('label'=>'Create Prescription', 'url'=>array('create')),
	array('label'=>'Manage Prescription', 'url'=>array('admin')),
);
?>

<h1>Prescriptions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
