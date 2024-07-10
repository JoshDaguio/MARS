<?php
/* @var $this SecretaryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Secretaries',
);

$this->menu=array(
	array('label'=>'Create Secretary', 'url'=>array('create')),
	array('label'=>'Manage Secretary', 'url'=>array('admin')),
);
?>

<h1>Secretaries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
