<?php
/* @var $this ClinicController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Clinics',
);

$this->menu=array(
	array('label'=>'Create Clinic', 'url'=>array('create')),
	array('label'=>'Manage Clinic', 'url'=>array('admin')),
);
?>

<h1>Clinics</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
