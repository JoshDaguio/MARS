<?php
/* @var $this ConsultationRecordController */
/* @var $model ConsultationRecord */
/* @var $form CActiveForm */

$patientDropdownData = CHtml::listData($PatientTable, 'id', function ($PatientTable) {
    // Assuming 'user' is the name of the relation in the Account model
    $user = $PatientTable->user;
    return $user->getFullname($user->account_id);;
});

$doctorDropdownData = CHtml::listData($DoctorTable, 'id', function ($DoctorTable) {
    // Assuming 'user' is the name of the relation in the Account model
    $user = $DoctorTable->user;
    return $user->getFullname($user->account_id);;
});
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'consultationRecord-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
        'class'=>'model',
    ),
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="form-group row">
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($model,'Patient'); ?>
			<?php echo $form->dropDownList($model, 'patient_account_id', $patientDropdownData, array('empty' => 'Select Patient', 'class'=>'form-control form-control-user')); ?>
			<?php echo $form->error($model,'patient_account_id'); ?>
		</div>
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($model,'Doctor'); ?>
			<?php echo $form->dropDownList($model, 'doctor_account_id', $doctorDropdownData, array('empty' => 'Select Doctor', 'class'=>'form-control form-control-user')); ?>
			<?php echo $form->error($model,'doctor_account_id'); ?>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($model,'subjective'); ?>
			<?php echo $form->textField($model,'subjective', array('class'=>'form-control form-control-user')); ?>
			<?php echo $form->error($model,'subjective'); ?>
		</div>
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($model,'objective'); ?>
			<?php echo $form->textField($model,'objective', array('class'=>'form-control form-control-user')); ?>
			<?php echo $form->error($model,'objective'); ?>
		</div>
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($model,'assessment'); ?>
			<?php echo $form->textField($model,'assessment', array('class'=>'form-control form-control-user')); ?>
			<?php echo $form->error($model,'assessment'); ?>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($model,'plan'); ?>
			<?php echo $form->textField($model,'plan', array('class'=>'form-control form-control-user')); ?>
			<?php echo $form->error($model,'plan'); ?>
		</div>
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($model,'notes'); ?>
			<?php echo $form->textField($model,'notes', array('class'=>'form-control form-control-user')); ?>
			<?php echo $form->error($model,'notes'); ?>
		</div>
		<div class="col-sm-4 mb-4 mb-sm-0">
			<?php echo $form->labelEx($model,'date_of_consultation'); ?>
			<?php
					$form->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model' => $model,		
					'attribute' => 'date_of_consultation',
					'name' => 'consultationRecord[date_of_consultation]',
					'value' => ($model->date_of_consultation!=''&&$model->date_of_consultation!='0000-00-00')?date('F d,Y', strtotime($model->date_of_consultation)):null,
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=> 'yy-mm-dd',
						'changeMonth'=>'true',
						'changeYear'=>'true',
						'minDate' => 'dateToday',
						'yearRange'=>date('Y').':'.(date('Y')+10),
					
					),
					'htmlOptions'=>array(
					'class'=>'form-control form-control-user',
					//'tabindex'=>'15',
					),
					));
				?> 
		</div>
	</div>

	<div class="form-group row">
		<div class="col-sm-12" style="text-align:right">
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('consultationRecord/listConsultation'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel creating this consultation?")')); ?>
			<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("consultationRecord-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
		</div>
	</div>
	<?php $this->endWidget(); ?>

</div><!-- form -->