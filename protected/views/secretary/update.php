<?php
/* @var $this SecretaryController */
/* @var $model Secretary */

$this->breadcrumbs=array(
	'Secretaries'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Secretary', 'url'=>array('index')),
	array('label'=>'Create Secretary', 'url'=>array('create')),
	array('label'=>'View Secretary', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Secretary', 'url'=>array('admin')),
);
?>

<h1>Update Secretary <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>