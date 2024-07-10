<?php
/* @var $this ConsultationRecordController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Consultation Records',
);

$this->menu=array(
	array('label'=>'Create ConsultationRecord', 'url'=>array('create')),
	array('label'=>'Manage ConsultationRecord', 'url'=>array('admin')),
);
?>

<h1>Consultation Records</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
