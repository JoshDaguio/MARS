<?php
/* @var $this ImmunizationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Immunizations',
);

$this->menu=array(
	array('label'=>'Create Immunization', 'url'=>array('create')),
	array('label'=>'Manage Immunization', 'url'=>array('admin')),
);
?>

<h1>Immunizations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
