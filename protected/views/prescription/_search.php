<?php
/* @var $this PrescriptionController */
/* @var $model Prescription */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'patient_account_id'); ?>
		<?php echo $form->textField($model,'patient_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doctor_account_id'); ?>
		<?php echo $form->textField($model,'doctor_account_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'consultation_id'); ?>
		<?php echo $form->textField($model,'consultation_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prescription'); ?>
		<?php echo $form->textArea($model,'prescription',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_of_prescription'); ?>
		<?php echo $form->textField($model,'date_of_prescription'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_id'); ?>
		<?php echo $form->textField($model,'status_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->